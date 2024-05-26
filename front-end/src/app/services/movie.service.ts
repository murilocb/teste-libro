import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { envs } from '../../environments/environments';

@Injectable({
  providedIn: 'root'
})
export class MovieService {
  private apiKey = envs.apiKey;
  private apiUrl = envs.apiurl;

  constructor(private http: HttpClient) { }

  getMovies(pageSize: number, page: number): Observable<any> {
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${this.apiKey}`
    });
    return this.http.get(`${this.apiUrl}/movie/popular`, {
      headers,
      params: {
        'page': page.toString(),
        'page_size': pageSize.toString()
      }
    });
  }

  getMovieDetails(id: number): Observable<any> {
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${this.apiKey}`
    });
    return this.http.get(`${this.apiUrl}/movie/${id}`, { headers });
  }
}
