<?php

it('connects to steer', function () {
    // I've no idea what I'm doing here...
    $client = Mockery::mock(\FredBradley\PhpSteerApi\Client::class);
    $client->shouldReceive('get');
});


it('accepts query builder', function () {
    $client = new \FredBradley\PhpSteerApi\Client('fake', 'fake', 'fake');
    $query = queryBuilder();
    $client->get('fake');
})->throws(\TypeError::class);
