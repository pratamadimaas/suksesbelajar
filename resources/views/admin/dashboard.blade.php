@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@push('styles')
<style>
    .dashboard-card {
        border-radius: 1rem;
        padding: 1.5rem;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
    }
    .dashboard-card .card-icon {
        font-size: 2.5rem;
        margin-right: 1rem;
        opacity: 0.8;
    }
    .dashboard-card .card-content {
        text-align: right;
    }
    .dashboard-card .card-label {
        margin: 0;
        font-size: 0.9rem;
        opacity: 0.9;
    }
    .dashboard-card .card-value {
        margin: 0;
        font-size: 2.25rem;
        font-weight: 600;
    }
    .primary-gradient {
        background: linear-gradient(45deg, #007bff, #0056b3);
    }
    .success-gradient {
        background: linear-gradient(45deg, #28a745, #1e7e34);
    }
    .warning-gradient {
        background: linear-gradient(45deg, #ffc107, #d39e00);
    }
    .danger-gradient {
        background: linear-gradient(45deg, #dc3545, #b82c39);
    }
    .g-4 {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 1.5rem;
    }
</style>
@endpush

@section('content')
<div class="row g-4">
    <div class="col-md-6 col-lg-3">
        <div class="dashboard-card primary-gradient">
            <div class="card-icon">
                <i class="bi bi-person-fill"></i>
            </div>
            <div class="card-content">
                <p class="card-label">Total Siswa</p>
                <h3 class="card-value">{{ $totalSiswa }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="dashboard-card success-gradient">
            <div class="card-icon">
                <i class="bi bi-question-circle-fill"></i>
            </div>
            <div class="card-content">
                <p class="card-label">Total Soal</p>
                <h3 class="card-value">{{ $totalSoal }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="dashboard-card warning-gradient">
            <div class="card-icon">
                <i class="bi bi-box-fill"></i>
            </div>
            <div class="card-content">
                <p class="card-label">Total Paket Ujian</p>
                <h3 class="card-value">{{ $totalPaket }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="dashboard-card danger-gradient">
            <div class="card-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="card-content">
                <p class="card-label">Total Ujian Selesai</p>
                <h3 class="card-value">{{ $totalUjian }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection