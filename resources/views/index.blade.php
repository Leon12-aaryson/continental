<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Select Location</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <div class="form-group">
            @php
                $countries = App\Models\Country::with('states.cities')->get();
            @endphp
            <label for="country">Country</label>
            <select name="country" id="country" class="form-control">
                <option value="">Select Country</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="state">State</label>
            <select name="state" id="state" class="form-control" disabled>
                <option value="">Select State</option>
            </select>
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <select name="city" id="city" class="form-control" disabled>
                <option value="">Select City</option>
            </select>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            const countries = @json($countries); // Get countries with states and cities

            $('#country').change(function() {
                const countryId = $(this).val();
                $('#state').empty().append('<option value="">Select State</option>').prop('disabled', true);
                $('#city').empty().append('<option value="">Select City</option>').prop('disabled', true);

                if (countryId) {
                    // Find the selected country
                    const selectedCountry = countries.find(country => country.id == countryId);
                    if (selectedCountry) {
                        // Populate states dropdown
                        $.each(selectedCountry.states, function(index, state) {
                            $('#state').append(`<option value="${state.id}">${state.name}</option>`);
                        });
                        $('#state').prop('disabled', false);
                    }
                }
            });

            $('#state').change(function() {
                const stateId = $(this).val();
                $('#city').empty().append('<option value="">Select City</option>').prop('disabled', true);

                if (stateId) {
                    // Find the selected state from the previously selected country
                    const countryId = $('#country').val();
                    const selectedCountry = countries.find(country => country.id == countryId);
                    if (selectedCountry) {
                        const selectedState = selectedCountry.states.find(state => state.id == stateId);
                        if (selectedState) {
                            // Populate cities dropdown
                            $.each(selectedState.cities, function(index, city) {
                                $('#city').append(`<option value="${city.id}">${city.name}</option>`);
                            });
                            $('#city').prop('disabled', false);
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>
