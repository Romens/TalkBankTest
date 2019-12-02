<?php

namespace Tests\Unit;

use App\Models\Promocode;
use App\Models\User;
use App\Services\PromocodeService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PromocodesTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @return void
     */
    public function testGenPromocode()
    {

        $user = factory(User::class)->create();
        $url = route('promocode.store');

        $data = [
            'value' => rand(0,100),
            'max_use_count' => rand(1, 10),
        ];

        $response = $this->actingAs($user)
            ->put($url, $data);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data',
            'success',
        ]);

        $response->assertJsonFragment(['success' => true]);
    }

    /**
     * @return void
     */
    public function testUsePromocode()
    {

        /** @var PromocodeService $promocodeService */
        $promocodeService = app(PromocodeService::class);

        /** @var Promocode $promocode*/
        $promocode = $promocodeService->genPromocode(
            rand(0,100),
            1
        );

        $user = factory(User::class)->create();
        $url = route('promocode.get') . '?name=' . $promocode->name;

        $response = $this->actingAs($user)
            ->get($url);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data',
            'success',
        ]);

        $response = $this->actingAs($user)
            ->get($url);

        $response->assertStatus(423);

        $result = $response->json();

        $this->assertFalse($result['success']);
        $this->assertEquals(__('promocode.max_use'), $result['errors'][0]);

    }
}
