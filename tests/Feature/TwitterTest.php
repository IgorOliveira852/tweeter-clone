<?php

use function Pest\Livewire\livewire;

it('should be able to create a tweet', function () {

    $user = \App\Models\User::factory()->create();

    \Pest\Laravel\actingAs($user);

    livewire(Tweet::class)
        ->set('body', 'This is my first tweet')
        ->call('tweet')
        ->assertEmitted('tweet::created');

    \Pest\Laravel\assertDatabaseCount('tweets', 1);

    expect(Tweet::first())
        ->body()->toBe('this is my first tweet')
        ->created_by()->toBe($user->id);
});
