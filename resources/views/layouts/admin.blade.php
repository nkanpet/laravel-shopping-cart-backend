@extends('adminlte::page')

@section('css')
@yield('custom-css')
@stop

@section('js')
@yield('custom-js')
@stack('push-custom-js')
@stop