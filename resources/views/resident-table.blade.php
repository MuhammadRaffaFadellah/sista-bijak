@extends('layouts.master')
@section('dashboard-title')
    Sista Bijak - Tabel Penduduk
@endsection
@section('body')
    @include('bootstrap-file')
    <div class="row align-items-center justify-content-center d-flex px-3 pb-3 pt-2">
        <div class="card shadow p-3 rounded-4">
            <div class="card-title">
                <h3 class="text-uppercase fw-bold font-roboto fs-5">Tabel Penduduk</h3>
            </div>
            <table class="table table-bordered table-hover table-striped mt-3">
                <thead>
                    <tr>
                        <th class="text-uppercase fw-bold text-center">No.</th>
                        <th class="text-uppercase fw-bold text-center">1</th>
                        <th class="text-uppercase fw-bold text-center">2</th>
                        <th class="text-uppercase fw-bold text-center">3</th>
                        <th class="text-uppercase fw-bold text-center">4</th>
                        <th class="text-uppercase fw-bold text-center">5</th>
                        <th class="text-uppercase fw-bold text-center">6</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">2</td>
                        <td class="text-center">3</td>
                        <td class="text-center">4</td>
                        <td class="text-center">5</td>
                        <td class="text-center">6</td>
                        <td class="text-center">7</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endsection
@yield('bootstrap')