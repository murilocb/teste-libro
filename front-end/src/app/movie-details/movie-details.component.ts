import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { MovieService } from '../services/movie.service';
import { CommonModule } from '@angular/common';
import { Location } from '@angular/common';
import { MatButtonModule } from '@angular/material/button'
import { MatCardModule } from '@angular/material/card';

@Component({
  selector: 'app-movie-details',
  templateUrl: './movie-details.component.html',
  styleUrls: ['./movie-details.component.css'],
  standalone: true,
  imports:[CommonModule, MatButtonModule, MatCardModule]
})
export class MovieDetailsComponent implements OnInit {
  movie: any;

  constructor(private route: ActivatedRoute, private movieService: MovieService, private location: Location) { }

  ngOnInit(): void {
    const idParam = this.route.snapshot.paramMap.get('id');
    if (idParam !== null) {
      const id = +idParam;
      this.movieService.getMovieDetails(id).subscribe((data: any) => {
        this.movie = data;
      });
    } else {
      console.error('No movie ID found in route parameters.');
    }
  }

  goBack(): void {
    this.location.back();
  }
}
