--1. SQL Queries
--Q1. What are the names of all movies released in 1995?
SELECT name FROM movies WHERE year=1995;

--Q2. How many people played a part in the movie ”Lost in Translation”?
SELECT COUNT(a.first_name) FROM actors a
JOIN roles r ON a.id=r.actor_id
JOIN movies m ON r.movie_id=m.id AND m.name='Lost in Translation'

--Q3. What are the names of all the people who played a part in the movie ”Lost in Translation”?
SELECT a.first_name, a.last_name FROM actors a
JOIN roles r ON a.id=r.actor_id
JOIN movies m ON r.movie_id=m.id AND m.name='Lost in Translation';

--Q4. Who directed the movie ”Fight Club”?
SELECT d.first_name, d.last_name FROM directors d
JOIN movies_directors m_d ON d.id=m_d.director_id
JOIN movies m ON m_d.movie_id=m.id AND m.name='Fight Club';

--Q5. How many movies has Clint Eastwood directed?
SELECT COUNT(name) FROM movies m
JOIN movies_directors m_d ON m.id=m_d.movie_id
JOIN directors d ON m_d.director_id=d.id AND d.first_name='Clint' AND d.last_name='Eastwood'

--Q6. What are the names of all movies Clint Eastwood has directed?
SELECT name FROM movies m
JOIN movies_directors m_d ON m.id=m_d.movie_id
JOIN directors d ON m_d.director_id=d.id AND d.first_name='Clint' AND d.last_name='Eastwood';

--Q7. What are the names of all directors who have directed at least one horror film?
SELECT first_name, last_name FROM directors d
JOIN movies_directors m_d ON d.id=m_d.director_id
JOIN movies_genres m_g ON m_d.movie_id=m_g.movie_id AND m_g.genre='Horror';

--Q8. What are the names of every actor who has appeared in a movie directed by Christopher Nolan?
SELECT a.first_name, a.last_name FROM actors a
JOIN roles r ON a.id=r.actor_id
JOIN movies_directors m_d ON r.movie_id=m_d.movie_id
JOIN directors d ON m_d.director_id=d.id AND d.first_name='Christopher'AND d.last_name='Nolan';