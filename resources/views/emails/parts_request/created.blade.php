@component('mail::message')
# New Parts Request

A new parts request has been made on PartsWeb and you are eligible to submit a quote.

@component('mail::table')
|                      |                                            |
|----------------------|--------------------------------------------|
| Vehicle Registration | **{{ $partsRequest->vehicle_registration  }}** |
| Make                 | **{{ $partsRequest->vehicle_make  }}**         |
| Model                | **{{ $partsRequest->vehicle_model  }}**        |
| Year                 | **{{ $partsRequest->vehicle_year }}**          |

@endcomponent

@component('mail::button', ['url' => url('/parts-requests/' . $partsRequest->id . '#bids')])
Quote For Parts
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
