@extends('layouts.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-6 col-sm-6 col-xs-12">
                            <h4 class="card-title">Company Detail: {{ $store->name }}</h4>
                        </div>
                        <div class="col-6 col-md-6 col-sm-6 col-xs-12 exelbuton" style="text-align:end;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="card-description">
                                <img src="{{ url('/uploads/store/' . $store->logo) }}" alt="" width="150px" height="150px">
                            </p>
                        </div>
                
                        <hr>
                        <div class="form-group">
                            <label for="total_share_partners">Total Partners</label>
                            <input type="number" class="form-control" id="total_share_partners" name="total_share_partners" value="0" step="any" />
                        </div>
                        <!-- Total Share Value Input -->
                        <div class="form-group">
                            <label for="total_share_value">Total Share Value</label>
                            <input type="number" class="form-control" id="total_share_value" name="total_share_value" step="any" value="0" placeholder="Enter total share value" />
                        </div>
                       
                        <div class="table-responsive">
                        <form class="form-sample" action="{{ route('store.partnters') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="store_id" value="{{ $store->id }}">
                            <div class="table-responsive">
                                <table class="table table-hover" width="100%" id="partner">
                                    <thead>
                                        <th width="5%">No</th>
                                        <th width="50%">Partners Name</th>
                                        <th width="15%">Percentage</th>
                                        <th width="30%">Share Value</th>
                                        <th width="5%">Action</th>
                                    </thead>
                                    <tbody>
                                        <!-- Rows will be dynamically added here -->
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2 submit">Submit<i class="fas fa-save"></i></button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>
$(document).ready(function() {
    // Initialize table rows based on total_share_partners value
    updateTableRows($('#total_share_partners').val());

    // Handle change in total_share_partners
    $('#total_share_partners').on('input', function() {
        var numRows = $(this).val();
        updateTableRows(numRows);
    });

    // Add new row
    function updateTableRows(count) {
        var $tableBody = $('#partner tbody');
        var currentRowCount = $tableBody.find('tr').length;
        
        if (count > currentRowCount) {
            // Add rows
            for (var i = currentRowCount + 1; i <= count; i++) {
                $tableBody.append(createRow(i));
            }
        } else if (count < currentRowCount) {
            // Remove rows
            $tableBody.find('tr').slice(count).remove();
        }
    }

    // Create a new row HTML
    function createRow(index) {
        return `
            <tr>
                <td>${index}</td>
                <td>
                    <select class="form-control form-control-lg partner-id" name="partners_id[]">
                        @foreach($partners as $partner)
                            <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" class="form-control percentage" name="percentage[]" step="any" />
                </td>
                <td>
                    <input type="number" class="form-control share_value" name="share_value[]" step="any" readonly />
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-row">Remove</button>
                </td>
            </tr>
        `;
    }

    // Calculate share value based on percentage and total share value
    $(document).on('input', '.percentage', function() {
        var totalShareValue = parseFloat($('#total_share_value').val());
        var percentage = parseFloat($(this).val());
        var shareValue = (totalShareValue * percentage) / 100;
        $(this).closest('tr').find('.share_value').val(shareValue.toFixed(2));
    });

    // Remove row
    $(document).on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
        updateRowNumbers();
    });

    // Update row numbers
    function updateRowNumbers() {
        $('#partner tbody tr').each(function(index) {
            $(this).find('td:first').text(index + 1);
        });
    }

    // Validate total percentage before submitting
    $('form').submit(function() {
        $(this).find('button[type="submit"]').attr('disabled', 'disabled');

        var per_cntg = grand_percentage_value();
        if (per_cntg != 100) {
            alert('Total Percentage should be 100');
            $(this).find('button[type="submit"]').removeAttr('disabled');
            return false;
        }

        $('.percentage').each(function() {
            CheckDecimal($(this).val());
        });
    });

    function grand_percentage_value() {
        var total = 0;
        $('.percentage').each(function() {
            total += parseFloat($(this).val());
        });
        return total;
    }
});
</script>
@endsection
