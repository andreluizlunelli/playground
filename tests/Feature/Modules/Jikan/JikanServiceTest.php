<?php

declare(strict_types=1);

use App\Modules\Jikan\JikanFacade;

describe('Jikan Module', function () {
   it('should be able to get top anime', function () {
       $data = [
           'data' => [
               "mal_id" => 0,
               "url" => "http://url",
               "title" => "Some title"
           ]
       ];

       JikanFacade::shouldReceive('top->animes')
           ->once()
           ->andReturn($data);

       $response = JikanFacade::top()->animes();

       expect($response)->toBe($data);
   });
});
