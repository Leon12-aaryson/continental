<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }

        .container {
            max-width: 800px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 2rem;
            margin-top: 20px;
        }

        p {
            font-size: 1.2rem;
        }

        code {
            background-color: #e9ecef;
            padding: 2px 4px;
            border-radius: 4px;
        }

        .endpoint {
            margin-top: 20px;
            text-align: left;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        @php
            $countries = App\Models\Country::all();
        @endphp
        <select name="country" id="country1" class="form-control">
            @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
        <h1>API Documentation</h1>
        <p>Welcome to the API documentation. Below you will find information on how to use our APIs.</p>

        <div class="endpoint">
            <h2>Geocode API</h2>
            <div class="mt-4">
                @php
                    $countries = App\Models\Country::all();
                @endphp
                <select name="country" id="country" class="form-control">
                    <option value="">Select Country</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <select name="state" id="state" class="form-control" disabled>
                    <option value="">Select State</option>
                </select>
            </div>

            <div class="mt-4">
                <select name="city" id="city" class="form-control" disabled>
                    <option value="">Select City</option>
                </select>
            </div>

            <script>
                document.getElementById('country2').addEventListener('change', function() {
                    var countryId = this.value;
                    if (countryId) {
                        fetch(`/api/states/${countryId}`)
                            .then(response => response.json())
                            .then(data => {
                                var stateSelect = document.getElementById('state');
                                stateSelect.innerHTML = '<option value="">Select State</option>';
                                data.forEach(state => {
                                    stateSelect.innerHTML += `<option value="${state.id}">${state.name}</option>`;
                                });
                                stateSelect.disabled = false;
                            });
                    } else {
                        document.getElementById('state').innerHTML = '<option value="">Select State</option>';
                        document.getElementById('state').disabled = true;
                        document.getElementById('city').innerHTML = '<option value="">Select City</option>';
                        document.getElementById('city').disabled = true;
                    }
                });

                document.getElementById('state').addEventListener('change', function() {
                    var stateId = this.value;
                    if (stateId) {
                        fetch(`/api/cities/${stateId}`)
                            .then(response => response.json())
                            .then(data => {
                                var citySelect = document.getElementById('city');
                                citySelect.innerHTML = '<option value="">Select City</option>';
                                data.forEach(city => {
                                    citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                                });
                                citySelect.disabled = false;
                            });
                    } else {
                        document.getElementById('city').innerHTML = '<option value="">Select City</option>';
                        document.getElementById('city').disabled = true;
                    }
                });
            </script>
            <p><strong>Endpoint:</strong> <code>/api/geocode</code></p>
            <p><strong>Method:</strong> GET</p>
            <p><strong>Description:</strong> This API takes an address and returns the corresponding coordinates.</p>
            <p><strong>Parameters:</strong></p>
            <ul>
                <li><code>address</code> (string) - The address to geocode.</li>
            </ul>
            <p><strong>Example Request:</strong></p>
            <code>GET /api/geocode?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA</code>
            <p><strong>Example Response:</strong></p>
            <code>
                {
                "latitude": 37.4224764,
                "longitude": -122.0842499
                }
            </code>
        </div>

        <div class="endpoint">
            <h2>Reverse Geocode API</h2>
            <p><strong>Endpoint:</strong> <code>/api/reverse-geocode</code></p>
            <p><strong>Method:</strong> GET</p>
            <p><strong>Description:</strong> This API takes coordinates and returns the corresponding address.</p>
            <p><strong>Parameters:</strong></p>
            <ul>
                <li><code>latitude</code> (float) - The latitude of the location.</li>
                <li><code>longitude</code> (float) - The longitude of the location.</li>
            </ul>
            <p><strong>Example Request:</strong></p>
            <code>GET /api/reverse-geocode?latitude=37.4224764&longitude=-122.0842499</code>
            <p><strong>Example Response:</strong></p>
            <code>
                {
                "address": "1600 Amphitheatre Parkway, Mountain View, CA"
                }
            </code>
        </div>

        {{-- <a href="/" class="button"><i class="fas fa-home"></i> Back to Home</a> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    </div>
</body>

</html>
