<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Movies;

class MoviesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function list_of_movies_can_be_retrieved(): void
    {
        $this->withoutExceptionHandling();

        factory(Movies::class, 5)->create();

        $response = $this->get('/movie');

        $response->assertOk();

        $movies = Movies::all();

        $response->assertViewIs('Movies/Index');
        $response->assertViewHas('movies', $movies);
    }   

    /** @test */
    public function a_movie_can_be_retrieved(): void
    {
        $this->withoutExceptionHandling();

        $movie = factory(Movies::class)->create();

        $response = $this->get('/movie', $movie->id);

        $response->assertOk();

        $movie = Movies::first();

        $response->assertViewIs('Movies/Show');
        $response->assertViewHas('movie', $movie);
    }   

    /** @test */
    public function a_movie_can_be_created(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/movie', [
            'name' => 'Test Name', 
            'publish' => '17-11-2023',
            'image' => 'test_image.jpg',
        ]);

        $this->assertCount(1, Movies::all());

        $movie = Movies::first();

        $this->assertEquals($movie->name, 'Test Name');
        $this->assertEquals($movie->publish, '17-11-2023');
        $this->assertEquals($movie->image, 'test_image.jpg');
        $this->assertEquals($movie->status, true);

        $response->assertRedirect('/movies/' . $movie->id);
    }    
    
    /** @test */
    public function an_created_movie_name_is_required(): void
    {    
        $this->withoutExceptionHandling();

        $response = $this->post('/movie', [
            'name' => '', 
            'publish' => '17-11-2023',
            'image' => 'test_image.jpg',
        ]);

        $response->assertSessionHasErrors(['name']);
    } 
    
    /** @test */
    public function an_created_movie_publish_is_required(): void
    {    
        $this->withoutExceptionHandling();

        $response = $this->post('/movie', [
            'name' => 'Test Name', 
            'publish' => '',
            'image' => 'test_image.jpg',
        ]);

        $response->assertSessionHasErrors(['publish']);
    }   
    
    /** @test */
    public function an_created_movie_image_is_required(): void
    {    
        $this->withoutExceptionHandling();

        $response = $this->post('/movie', [
            'name' => 'Test Name', 
            'publish' => '17-11-2023',
            'image' => '',
        ]);

        $response->assertSessionHasErrors(['image']);
    }   

    /** @test */
    public function a_movie_can_be_updated(): void
    {
        $this->withoutExceptionHandling();

        $movie = factory(Movies::class)->create();

        $response = $this->put('/movie', $movie->id, [
            'name' => 'Test Edit Name', 
            'publish' => '11-11-2023',
            'image' => 'test_edit_image.jpg',
            'status' => false,
        ]);

        $this->assertCount(1, Movies::all());

        $movie = Movies::fresh();

        $this->assertEquals($movie->name, 'Test Edit Name');
        $this->assertEquals($movie->publish, '11-11-2023');
        $this->assertEquals($movie->image, 'test_edit_image.jpg');
        $this->assertEquals($movie->status, false);

        $response->assertRedirect('/movies/' . $movie->id);
    }   
    
    /** @test */
    public function an_updated_movie_name_is_required(): void
    {    
        $this->withoutExceptionHandling();

        $response = $this->put('/movie', [
            'name' => '', 
            'publish' => '17-11-2023',
            'image' => 'test_image.jpg',
        ]);

        $response->assertSessionHasErrors(['name']);
    }   
    
    /** @test */
    public function an_updated_movie_publish_is_required(): void
    {    
        $this->withoutExceptionHandling();

        $response = $this->put('/movie', [
            'name' => 'Test Name', 
            'publish' => '',
            'image' => 'test_image.jpg',
        ]);

        $response->assertSessionHasErrors(['publish']);
    }   
    
    /** @test */
    public function an_updated_movie_image_is_required(): void
    {    
        $this->withoutExceptionHandling();

        $response = $this->put('/movie', [
            'name' => 'Test Name', 
            'publish' => '17-11-2023',
            'image' => '',
        ]);

        $response->assertSessionHasErrors(['image']);
    }   

    /** @test */
    public function a_movie_can_be_assigned_to_turns(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }  

    /** @test */
    public function a_movie_can_be_deleted(): void
    {
        $this->withoutExceptionHandling();

        $movie = factory(Movies::class)->create();

        $response = $this->delete('/movie', $movie->id);

        $this->assertCount(0, Movies::all());

        $response->assertRedirect('/movies');
    }  
}