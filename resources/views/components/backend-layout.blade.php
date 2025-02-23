@extends("backend.layouts.master")
@section('title', config('app.name', 'Web DashBoard'))

@if (isset($styles))
   @section('styles')
      {{ $styles }}
      <style>
         img,
         svg,
         video,
         canvas,
         audio,
         iframe,
         embed,
         object {
            display: unset
         }

      </style>
   @endsection
@endif
@if (isset($high_priority_scripts))
   @section('high_priority_scripts')
      {{ $high_priority_scripts }}
   @endsection
@endif

@section('breadcrumb-title', $breadcrumb_title)
@section('breadcrumb-items')
   {{ $breadcrumb_items }}
@endsection

@section('content')
   {{ $slot }}
@endsection

@if (isset($scripts))
   @section('scripts')
      {{ $scripts }}
   @endsection
@endif
