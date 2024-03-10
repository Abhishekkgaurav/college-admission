<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online +2 Science Colleg Admission Form</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #e9ecef;

        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #343a40;
        }

        .form-control {
            border-radius: 5px;
        }

        .form-check-input {
            margin-right: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .yellow-row {
            background-color: #ffff99;

        }

        .grey-row {
            background-color: #f8f9fa;

        }

        th {
            background-color: #007bff;

            color: #ffffff;

        }
    </style>
</head>

<body>


    @if (session()->has('success'))
        <script>
            alert("{{ session()->get('success') }}");
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            alert("{{ session()->get('error') }}");
        </script>
    @endif
    @if (session()->has('errors'))
        <script>
            alert("{{ session()->get('error') }}");
        </script>
    @endif


    <div class="container mt-5">
        <h2 class="mt-5 mb-3 text-center text-info">Online +2 Science Colleg Admission Form</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Applicant's Details</h5>
                <form method="post" action="{{ route('admissions.add') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="applicantName">Applicant Name *</label>
                            <input type="text" class="form-control" required id="applicantName" name="applicantName">



                        </div>
                        <div class="form-group col-md-4">
                            <label for="collegeName">College Name *</label>
                            <select class="form-control" id="collegeName" name="collegeName" required>
                                <option value="" hidden="hidden">--Select--</option>
                                @foreach ($colleges as $college)
                                    <option value="{{ $college->college_id }}">{{ $college->college_name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="optionalField">Optional Field *</label>
                            <div class="form-check">
                                <input required class="form-check-input" type="radio" name="optionalField"
                                    id="optionalFieldMath" value="math">
                                <label class="form-check-label" for="optionalFieldMath">
                                    Math
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="optionalField"
                                    id="optionalFieldBio" value="biology">
                                <label class="form-check-label" for="optionalFieldBio">
                                    Biology
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 text-right">
                            <button type="submit" class="btn btn-primary" name="sbtn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="container mt-5">
        <h2>Registration Details</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>SI.#</th>
                    <th>Name</th>
                    <th>College Name</th>
                    <th>Fourth Optional</th>
                    <th>Enrollment Date</th>
                    <th>Course Fee</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alldetails as $detail)
                    <tr class="{{ $loop->index % 2 == 0 ? 'yellow-row' : 'grey-row' }}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $detail->applicant_name }}</td>
                        <td>{{ $detail->college_name }}</td>
                        <td>{{ $detail->fourth_optional }}</td>
                        <td>{{ $detail->enrollment_date }}</td>
                        <td>{{ $detail->course_fee }}</td>
                        <td>
                            <button type="button" class="btn btn-danger delete-btn"
                                data-admission-id="{{ $detail->enrollment_id }}">
                                Delete
                            </button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var admissionId = $(this).data('admission-id');

                if (confirm('Are you sure you want to delete this record?')) {
                    $.ajax({
                        url: '{{ route('admissions.delete') }}',
                        type: 'GET',
                        data: {
                            admission_id: admissionId,

                        },
                        success: function(response) {

                            alert(response.message);

                            location.reload();
                        },
                        error: function(xhr, status, error) {

                            alert('An error occurred while deleting the record.');
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>
