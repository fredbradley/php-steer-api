<?php

it('can set a year', function () {
    $queryBuilder = queryBuilder();
    $year = 2021;
    $queryBuilder->setYear($year);
    expect($queryBuilder->year)->toBe($year);
});
it('can filter by house', function () {
    $queryBuilder = queryBuilder();
    $house = 'Balmoral';
    $queryBuilder->filterHouse($house);
    expect($queryBuilder->filters['house'])->toBe($house);
});
it('can filter by round', function () {
    $queryBuilder = queryBuilder();
    $round = 1;
    $queryBuilder->filterRound($round);
    expect($queryBuilder->filters['round'])->toBe($round);
});
it('can filter by campus', function () {
    $queryBuilder = queryBuilder();
    $campus = 'Senior';
    $queryBuilder->filterCampus($campus);
    expect($queryBuilder->filters['campus'])->toBe($campus);
});
it('can filter by year', function () {
    $queryBuilder = queryBuilder();
    $year = 2021;
    $queryBuilder->filterYear($year);
    expect($queryBuilder->filters['year'])->toBe($year);
});
it('can filter by gender', function () {
    $queryBuilder = queryBuilder();
    $gender = 'm';
    $queryBuilder->filterGender($gender);
    expect($queryBuilder->filters['gender'])->toBe($gender);
});
it('can sanitize gender male', function () {
    $queryBuilder = queryBuilder();
    $gender = "MALE";
    $queryBuilder->filterGender($gender);
    expect($queryBuilder->filters['gender'])->toBe('m');
});
it('can sanitize gender female', function () {
    $queryBuilder = queryBuilder();
    $gender = "girls";
    $queryBuilder->filterGender($gender);
    expect($queryBuilder->filters['gender'])->toBe('f');
});
it('can throw exception on unknown gender', function () {
    $queryBuilder = queryBuilder();
    $gender = "hooligans";
    $queryBuilder->filterGender($gender);
})->throws(\Exception::class);
it('can filter by misid', function () {
    $queryBuilder = queryBuilder();
    $misId = '123456';
    $queryBuilder->filterMisId($misId);
    expect($queryBuilder->filters['mis_id'])->toBe($misId);
});
