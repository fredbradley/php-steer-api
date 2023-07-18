<?php

it('connects to steer', function () {
    $json = '{ "data": [{"sn_in": ""},{"gender":"m"}]}';
    // I've no idea what I'm doing here...
    $client = Mockery::mock(\FredBradley\PhpSteerApi\Client::class);
    $client->shouldReceive('get')
        ->andReturn(json_decode($json));
    $mockResponse = new \GuzzleHttp\Handler\MockHandler([
        new \GuzzleHttp\Psr7\Response(200, [], $json),
    ]);

    expect($client->get(queryBuilder()))
        ->toBeObject();
});


it('accepts query builder', function () {
    $client = new \FredBradley\PhpSteerApi\Client('fake', 'fake', 'fake');
    $query = queryBuilder();
    $client->get('fake');
})->throws(\TypeError::class);
