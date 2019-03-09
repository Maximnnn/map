<?php

namespace App\Services;


class TestGetter implements MapGetterInterface
{


    public function getRoutes(array $filter): array
    {
        return json_decode('{
    "data": {
        "units": [
            {
                "unit_id": 1,
                "routes": [
                    {
                        "type": "stop",
                        "route_id": 987988691,
                        "start": {
                            "time": "2013-03-12T15:07:06Z",
                            "address": "N\u0101ras iela 6, \u0136ekava, \u0136ekavas pag., \u0136ekavas nov.",
                            "lat": 56.1368,
                            "lng": 24.8169
                        },
                        "end": {
                            "time": "2013-03-13T05:50:02Z"
                        }
                    },
                    {
                        "type": "route",
                        "route_id": 9785023147,
                        "start": {
                            "time": "2013-03-13T05:50:02Z",
                            "address": "N\u0101ras iela 6, \u0136ekava, \u0136ekavas pag., \u0136ekavas nov.",
                            "lat": 56.1368,
                            "lng": 24.8169,
                            "can": {
                                "fuel_level": 13,
                                "service_distance": 13000,
                                "total_distance": 12131,
                                "total_fuel": 152,
                                "total_engine_hours": 2041
                            }
                        },
                        "end": {
                            "time": "2013-03-13T06:06:27Z",
                            "address": "Augstceltne, Daugmale, Daugmales pag., \u0136ekavas nov.",
                            "lat": 56.9217,
                            "lng": 24.3145,
                            "can": {
                                "fuel_level": 13,
                                "service_distance": 13131,
                                "total_distance": 13131,
                                "total_fuel": 222,
                                "total_engine_hours": 2341
                            }
                        },
                        "avg_speed": 52,
                        "max_speed": 72,
                        "decoded_route": {
                            "points": [
                                {
                                    "gmt": "2017-04-03T14:44:16Z",
                                    "lat": 56.9259,
                                    "lng": 24.0196,
                                    "speed": 0
                                }
                            ]
                        },
                        "distance": 15770,
                        "countries": [
                            {
                                "code": "RU",
                                "distance": 31546,
                                "time": 1324
                            },
                            {
                                "code": "LV",
                                "distance": 956461,
                                "time": 3536
                            }
                        ],
                        "driver_id": 43722,
                        "route_details": {
                            "type": "new",
                            "group_id": "10",
                            "explanation": "Explanation",
                            "explanation_time": "2019-01-25 02:12:00"
                        }
                    }
                ]
            }
        ]
    }
}', true);
    }

    public function getUnits(array $filter): array
    {
        return json_decode('{
    "data": {
        "units": [
            {
                "unit_id": 1,
                "box_id": 1,
                "company_id": 1,
                "country_code": "LV",
                "label": "VOLVO FH",
                "number": "XX1234",
                "vin": "xxx",
                "type": "car",
                "lat": 38.30008,
                "lng": 23.65109,
                "direction": 0,
                "speed": 10,
                "mileage": 113746523,
                "last_update": "2017-05-22T12:23:46Z",
                "ignition_total_time": 16508293,
                "state": {
                    "name": "standing",
                    "start": "2017-05-22T11:21:13Z",
                    "duration": 3840,
                    "debug_info": {
                        "msg": "LOW VOLTAGE",
                        "data": {
                            "battery": "1",
                            "last_voltage": "4.43",
                            "power_status": "on",
                            "power_status_gmt": "2016-09-30 12:27:05",
                            "last_data": 1479280400
                        }
                    }
                },
                "movement_state": {
                    "name": "standing",
                    "start": "2017-05-22T11:21:13Z",
                    "duration": 3840
                },
                "supply_voltage": {
                    "gmt": "2017-12-27T11:35:51Z",
                    "value": 25.71
                },
                "battery_voltage": {
                    "gmt": "2017-12-27T11:37:51Z",
                    "value": 215.71
                },
                "device": {
                    "id": 1,
                    "serial_number": "1",
                    "imei": 11111
                },
                "io_din": [
                    {
                        "no": 1,
                        "label": "Alarm",
                        "state": "0"
                    },
                    {
                        "no": 2,
                        "label": "Ignition",
                        "state": "1"
                    }
                ],
                "connected": {
                    "unit_id": "2",
                    "type": "trailer",
                    "location": {
                        "lat": "38.2998",
                        "lng": "23.651"
                    }
                },
                "fuel": [
                    {
                        "type": "CAN",
                        "metrics": "L",
                        "value": 2052,
                        "last_update": "2017-05-22T11:21:53Z"
                    }
                ],
                "in_objects": {
                    "objects": [
                        {
                            "object_id": "1",
                            "name": "R\u012bga"
                        }
                    ]
                },
                "temperature": {
                    "temp_2": {
                        "gmt": "2017-05-17T09:02:38Z",
                        "value": 16.28
                    }
                },
                "ambienttemp": {
                    "gmt": "2017-05-22T11:38:01Z",
                    "value": 28.3
                },
                "can": {
                    "odom": {
                        "gmt": "2017-05-22T11:38:01Z",
                        "value": "115224.965"
                    },
                    "fuel_total": {
                        "gmt": "2017-05-22T11:41:08Z",
                        "value": "30527.5"
                    },
                    "engine_hours": {
                        "gmt": "2017-05-22T11:21:51Z",
                        "value": "1719.45"
                    }
                },
                "reefer": {
                    "0": {
                        "flags": {
                            "flag": {
                                "value": 1,
                                "gmt": "2016-01-26T06:55:30Z"
                            }
                        },
                        "hours": {
                            "diesel": {
                                "value": 1788,
                                "gmt": "2016-01-26T06:55:30Z"
                            },
                            "electric": {
                                "value": 8,
                                "gmt": "2016-01-26T06:55:30Z"
                            },
                            "standby": {
                                "value": 97,
                                "gmt": "2016-01-26T06:55:30Z"
                            }
                        },
                        "mode": {
                            "power": {
                                "value": 0,
                                "gmt": "2016-01-26T06:55:30Z"
                            },
                            "run": {
                                "value": 1,
                                "gmt": "2016-01-26T06:55:30Z"
                            },
                            "speed": {
                                "value": 0,
                                "gmt": "2016-01-26T06:55:30Z"
                            }
                        },
                        "temperature": {
                            "return": {
                                "value": 4.7,
                                "gmt": "2016-01-26T06:55:30Z"
                            },
                            "setpoint": {
                                "value": 4,
                                "gmt": "2016-01-26T06:55:30Z"
                            },
                            "supply": {
                                "value": 1.5,
                                "gmt": "2016-01-26T06:55:30Z"
                            }
                        },
                        "state": {
                            "value": "off",
                            "gmt": "2016-01-26T06:55:30Z"
                        }
                    },
                    "refrigerator_communication_type": "2",
                    "refrigerator_compartment_count": "1",
                    "refrigerator_type": "THERMOKING"
                },
                "drivers": {
                    "driver1": {
                        "id": "1",
                        "name": "Name Surname",
                        "phone": "",
                        "ibutton": "",
                        "tacho_id": "00000000000001"
                    },
                    "driver2": {
                        "id": "2",
                        "name": "Name Surname",
                        "phone": "",
                        "ibutton": "",
                        "tacho_id": "00000000000002"
                    }
                },
                "relays": [
                    {
                        "relay_id": "1",
                        "relay_state": "0",
                        "type": "basic",
                        "title": "Door",
                        "inverted": "0",
                        "control_while_moving": "0",
                        "enabled": "1"
                    },
                    {
                        "relay_id": "2",
                        "relay_state": "1",
                        "type": "engine_block",
                        "title": "Engine",
                        "inverted": "0",
                        "control_while_moving": "0",
                        "enabled": "1"
                    }
                ],
                "application_fields": [
                    {
                        "id": 1,
                        "application_id": 1,
                        "level": "vehicle",
                        "type": "text",
                        "title": "Text title",
                        "title_translation": null,
                        "unique_per_company": false,
                        "value": "xx"
                    }
                ]
            }
        ]
    }
}', true);
    }
}