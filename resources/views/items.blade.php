<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

  </head>
  <body>


<div class="container mt-5">
    {{-- <a href="#" class="btn btn-danger" id="deleteAllSelectedRecord">Delete All Selected</a> --}}

    <div class="form-control">
        <select name="status" id="status">
            <option value="Rasha">Rasha</option>
            <option value="Nipun">Nipun</option>
        </select>
    </div>
    
    <button id="updateStatus">Update Status</button>
    

    <table class="table" id="myTable">
        <thead>
            <tr>
                <th><input type="checkbox" name="" id="select_all_ids"></th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr id="employee_ids{{ $item->id}}">
                    <td><input type="checkbox" name="ids" class="checkbox_ids" id="" value="{{ $item->id}}"></td>
                    <td>{{ $item->column1 }}</td>
                    <td>{{ $item->column2 }}</td>
                    <td>{{ $item->status }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(function(e) {
        $("#select_all_ids").click(function() {
            $('.checkbox_ids').prop('checked', $(this).prop('checked'));
        });

        $('#updateStatus').click(function(e) {
            e.preventDefault();
            var all_ids = [];
            $('input:checkbox[name=ids]:checked').each(function() {
                all_ids.push($(this).val());
            });

            var status = $('#status').val();

          

            $.ajax({
                url: "{{ route('employee.update') }}",
                type: "POST",
                data: {
                    ids: all_ids,
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $.each(all_ids, function(key, val) {
                        $('#employee_ids' + val).html(response);
                    });
                }
            });
        });
    });
</script>

  



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

   <script>
     $(document).ready( function () {
        $('#myTable').DataTable();
    } );
   </script>

  </body>
</html>