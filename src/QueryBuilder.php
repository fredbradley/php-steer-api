<?php

namespace FredBradley\PhpSteerApi;

class QueryBuilder
{
    /**
     * @var array<string, string|int>
     */
    public array $filters = [];
    public ?int $year = null;

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }
    public function filterHouse(string $house): self
    {
        $this->filters['house'] = $house;

        return $this;
    }

    public function filterRound(int $round): self
    {
        $this->filters['round'] = $round;

        return $this;
    }

    public function filterCampus(string $campus): self
    {
        $this->filters['campus'] = $campus;

        return $this;
    }

    public function filterYear(int $year): self
    {
        $this->filters['year'] = $year;

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function filterGender(string $gender): self
    {
        if (in_array(strtolower($gender), ['m', 'male', 'boys', 'males', 'boy'])) {
            $gender = 'm';
        }
        if (in_array(strtolower($gender), ['f', 'female', 'girls', 'females', 'girl', 'women'])) {
            $gender = 'f';
        }
        if (!in_array($gender, ['m', 'f'])) {
            throw new \Exception("Gender must be either 'm' or 'f'. You passed: {$gender}");
        }
        $this->filters['gender'] = $gender;

        return $this;
    }

    public function filterMisId(string $misId): self
    {
        $this->filters['mis_id'] = $misId;

        return $this;
    }
}
