package com.lmh.minhhoang.movieapp.movieList.presentation.Search

import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.google.firebase.firestore.ktx.firestore
import com.google.firebase.ktx.Firebase
import com.lmh.minhhoang.movieapp.movieList.domain.model.Movies
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.SharingStarted
import kotlinx.coroutines.flow.combine
import kotlinx.coroutines.flow.stateIn
import kotlinx.coroutines.launch
import kotlinx.coroutines.tasks.await

class SearchViewModel : ViewModel() {
    private val _searchText = MutableStateFlow("")
    val searchText = _searchText

    private val _isSearching = MutableStateFlow(false)
    val isSearching = _isSearching

    private val _movies = MutableStateFlow<List<Movies>>(emptyList())
    val movies = _searchText.combine(_movies) { text, movies ->
        if (text.isBlank()) {
            movies
        } else {
            movies.filter { it.doesMatchSearchQuery(text) }
        }
    }.stateIn(
        viewModelScope,
        SharingStarted.WhileSubscribed(5000),
        emptyList()
    )

    init {
        loadMovies()
    }

    fun onSearchTextChange(text: String) {
        _searchText.value = text
    }

    private fun loadMovies() {
        viewModelScope.launch {
            try {
                val movieList = getMoviesFromFirestore()
                _movies.value = movieList
            } catch (e: Exception) {
            }
        }
    }

    private suspend fun getMoviesFromFirestore(): List<Movies> {
        val firestore = Firebase.firestore
        val querySnapshot = firestore.collection("movies").get().await()
        val movieList = mutableListOf<Movies>()
        for (document in querySnapshot.documents) {
            val title = document.getString("name_movie")
            val imageUrl = document.getString("file_movie")
            val id = document.getString("code_phim")
            val power = document.getString("power")
            if (!title.isNullOrEmpty()&&!imageUrl.isNullOrEmpty()&&!id.isNullOrEmpty()&&!power.isNullOrEmpty()) {
                val movie = Movies(
                    id =id,
                    title = title,
                    poster_path = imageUrl,
                    power = power,
                )
                movieList.add(movie)
            }
        }
        return movieList
    }
}