import { Component, OnInit } from '@angular/core';
import { MovieService } from '../services/movie.service';
import { CommonModule } from '@angular/common';
import { Router } from '@angular/router';
import { MatButtonModule } from '@angular/material/button'
import { MatCardModule } from '@angular/material/card';
import { MatPaginatorModule, PageEvent } from '@angular/material/paginator';

@Component({
  selector: 'app-movie-list',
  templateUrl: './movie-list.component.html',
  styleUrls: ['./movie-list.component.css'],
  standalone: true,
  imports:[CommonModule, MatButtonModule, MatCardModule, MatPaginatorModule]
})
export class MovieListComponent implements OnInit {
  movies: any[] = [];
  totalMovies: number = 0;
  pageSize: number = 20;
  currentPage: number = 1;

  constructor(private movieService: MovieService, private router: Router) {}

  ngOnInit(): void {
    this.getMovies();
  }

  getMovies(): void {
    this.movieService.getMovies(this.pageSize, this.currentPage).subscribe((data: any) => {
      this.movies = data.results;
      this.totalMovies = data.total_results;
    });
  }

  onPageChange(event: PageEvent): void {
    this.currentPage = event.pageIndex + 1;
    this.pageSize = event.pageSize;
    this.getMovies();
  }

  getMoviePosterUrl(posterPath: string): string {
    if (posterPath) {
      return `https://image.tmdb.org/t/p/w500${posterPath}`;
    } else {
      return 'https://via.placeholder.com/500x750';
    }
  }

  verDetalhes(movieId: number): void {
    this.router.navigate(['/movie', movieId]);
  }
}
