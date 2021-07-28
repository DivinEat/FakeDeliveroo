<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an order';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        /** @var Store $store */
        $store = Store::all()->first();

        Order::create([
            'order_id' => Str::uuid()->toString(),
            'created_at' => Carbon::now()->subMinutes(5),
            'order_events' => [
                [
                    'id' => random_int(1, 99999),
                    'event_type' => 'ACCEPTED',
                    'payload' => $this->getOrderCreateEvent()
                ]
            ],
            'order_sync_statuses' => [],
            'order_prep_stages' => []
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $store->webhook_deliveroo);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        dd($output);
    }

    protected function getOrderCreateEvent(): array
    {
        return [
            "event" => "new_order",
            "location_id" => "72",
            "restaurant_acknowledged_at" => "2018-12-11T14 => 40 => 35Z",
            "order" => [
                "id" => "1544539233-7465",
                "display_id" => "7465",
                "total_price" => [
                    "fractional" => 1795,
                    "currency_code" => "EUR"
                ],
                "items" => [
                    [
                        "pos_item_id" => "30086/dog",
                        "unit_price" => [
                            "fractional" => 550,
                            "currency_code" => "EUR"
                        ],
                        "quantity" => 1,
                        "modifiers" => [
                            [
                                "pos_item_id" => "70059/mayo",
                                "unit_price" => [
                                    "fractional" => 0,
                                    "currency_code" => "EUR"
                                ],
                                "quantity" => 1,
                                "modifiers" => [

                                ]
                            ],
                            [
                                "pos_item_id" => "70060/lett",
                                "unit_price" => [
                                    "fractional" => 0,
                                    "currency_code" => "EUR"
                                ],
                                "quantity" => 1,
                                "modifiers" => [

                                ]
                            ],
                            [
                                "pos_item_id" => "70055/pickle",
                                "unit_price" => [
                                    "fractional" => 0,
                                    "currency_code" => "EUR"
                                ],
                                "quantity" => 1,
                                "modifiers" => [

                                ]
                            ],
                            [
                                "pos_item_id" => "70064/gronions",
                                "unit_price" => [
                                    "fractional" => 0,
                                    "currency_code" => "EUR"
                                ],
                                "quantity" => 1,
                                "modifiers" => [

                                ]
                            ],
                            [
                                "pos_item_id" => "70058/grmush",
                                "unit_price" => [
                                    "fractional" => 0,
                                    "currency_code" => "EUR"
                                ],
                                "quantity" => 1,
                                "modifiers" => [

                                ]
                            ],
                            [
                                "pos_item_id" => "70061/ketchup",
                                "unit_price" => [
                                    "fractional" => 0,
                                    "currency_code" => "EUR"
                                ],
                                "quantity" => 1,
                                "modifiers" => [

                                ]
                            ],
                            [
                                "pos_item_id" => "70053/relish",
                                "unit_price" => [
                                    "fractional" => 0,
                                    "currency_code" => "EUR"
                                ],
                                "quantity" => 1,
                                "modifiers" => [

                                ]
                            ],
                            [
                                "pos_item_id" => "70056/onions",
                                "unit_price" => [
                                    "fractional" => 0,
                                    "currency_code" => "EUR"
                                ],
                                "quantity" => 1,
                                "modifiers" => [

                                ]
                            ],
                            [
                                "pos_item_id" => "70062/jalpepp",
                                "unit_price" => [
                                    "fractional" => 0,
                                    "currency_code" => "EUR"
                                ],
                                "quantity" => 1,
                                "modifiers" => [

                                ]
                            ]
                        ]
                    ],
                    [
                        "pos_item_id" => "30097/cjfries-s",
                        "unit_price" => [
                            "fractional" => 345,
                            "currency_code" => "EUR"
                        ],
                        "quantity" => 1,
                        "modifiers" => [

                        ]
                    ],
                    [
                        "pos_item_id" => "30114/shake",
                        "unit_price" => [
                            "fractional" => 525,
                            "currency_code" => "EUR"
                        ],
                        "quantity" => 1,
                        "modifiers" => [
                            [
                                "pos_item_id" => "70129/oeromix",
                                "unit_price" => [
                                    "fractional" => 0,
                                    "currency_code" => "EUR"
                                ],
                                "quantity" => 1,
                                "modifiers" => [

                                ]
                            ]
                        ]
                    ],
                    [
                        "pos_item_id" => "30088/grcheese",
                        "unit_price" => [
                            "fractional" => 375,
                            "currency_code" => "EUR"
                        ],
                        "quantity" => 1,
                        "modifiers" => [
                            [
                                "pos_item_id" => "70060/lett",
                                "unit_price" => [
                                    "fractional" => 0,
                                    "currency_code" => "EUR"
                                ],
                                "quantity" => 1,
                                "modifiers" => [

                                ]
                            ],
                            [
                                "pos_item_id" => "70055/pickle",
                                "unit_price" => [
                                    "fractional" => 0,
                                    "currency_code" => "EUR"
                                ],
                                "quantity" => 1,
                                "modifiers" => [

                                ]
                            ],
                            [
                                "pos_item_id" => "70064/gronions",
                                "unit_price" => [
                                    "fractional" => 0,
                                    "currency_code" => "EUR"
                                ],
                                "quantity" => 1,
                                "modifiers" => [

                                ]
                            ],
                            [
                                "pos_item_id" => "70058/grmush",
                                "unit_price" => [
                                    "fractional" => 0,
                                    "currency_code" => "EUR"
                                ],
                                "quantity" => 1,
                                "modifiers" => [

                                ]
                            ],
                            [
                                "pos_item_id" => "70056/onions",
                                "unit_price" => [
                                    "fractional" => 0,
                                    "currency_code" => "EUR"
                                ],
                                "quantity" => 1,
                                "modifiers" => [

                                ]
                            ],
                            [
                                "pos_item_id" => "70062/jalpepp",
                                "unit_price" => [
                                    "fractional" => 0,
                                    "currency_code" => "EUR"
                                ],
                                "quantity" => 1,
                                "modifiers" => [

                                ]
                            ]
                        ]
                    ]
                ],
                "asap" => true,
                "notes" => "NO CUTLERY",
                "fulfillment_type" => "deliveroo",
                "offer_discount" => [
                    "amount" => [
                        "fractional" => 0,
                        "currency_code" => "EUR"
                    ]
                ],
                "pickup_at" => "2018-12-11T14 => 54 => 11Z"
            ]
        ];
    }
}
