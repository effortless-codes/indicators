<link href="{{ asset('vendor/indicator/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('vendor/indicator/plugins.bundle.js') }}"></script>

@php
    $indicatorConfig = \Illuminate\Support\Facades\Session::get('notify.config');
    $indicatorConfig = json_decode($indicatorConfig, true);
@endphp

@if($indicatorConfig['type'] == 'alert')

@else
    <script>
        toastr.options = @json($indicatorConfig);

        toastr.success("{{ $indicatorConfig['text'] }}", "{{ $indicatorConfig['title'] }}");
    </script>
@endif
