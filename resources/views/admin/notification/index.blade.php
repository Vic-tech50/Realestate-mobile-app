@extends('web.main')

@section('content')

<style>
    /* ==============================
       Notifications Page
    ============================== */

    .notifications-page {
        background: #f6f8fb;
        min-height: 100vh;
    }

    .page-header-modern {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .page-header-modern .title h4 {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 5px;
    }

    .page-header-modern .title p {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 0;
    }

    .notification-create-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 18px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        color: #fff;
        background: #16a34a;
        transition: all .2s ease;
    }

    .notification-create-btn:hover {
        color: #fff;
        background: #15803d;
        transform: translateY(-1px);
    }

    /* ==============================
       Statistics
    ============================== */

    .notification-stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid #edf0f3;
        box-shadow: 0 4px 18px rgba(0, 0, 0, .04);
        height: 100%;
    }

    .notification-stat-card .stat-icon {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ecfdf3;
        color: #16a34a;
        font-size: 20px;
        margin-bottom: 15px;
    }

    .notification-stat-card h3 {
        font-size: 24px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 3px;
    }

    .notification-stat-card p {
        margin: 0;
        color: #6b7280;
        font-size: 13px;
    }

    /* ==============================
       Main Card
    ============================== */

    .notifications-card {
        background: #fff;
        border-radius: 14px;
        border: 1px solid #edf0f3;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .04);
        overflow: hidden;
    }

    .notifications-card-header {
        padding: 20px 22px;
        border-bottom: 1px solid #edf0f3;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        flex-wrap: wrap;
    }

    .notifications-card-header h5 {
        margin: 0;
        font-size: 17px;
        font-weight: 700;
        color: #1f2937;
    }

    .notifications-card-header p {
        margin: 4px 0 0;
        font-size: 13px;
        color: #6b7280;
    }

    /* ==============================
       Table
    ============================== */

    .notifications-table {
        margin: 0 !important;
        width: 100%;
    }

    .notifications-table thead th {
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        color: #6b7280;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
        padding: 15px 18px;
        white-space: nowrap;
    }

    .notifications-table tbody td {
        padding: 17px 18px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f2f5;
        color: #374151;
        font-size: 14px;
    }

    .notifications-table tbody tr {
        transition: background .2s ease;
    }

    .notifications-table tbody tr:hover {
        background: #fafdfb;
    }

    .notification-title-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 230px;
    }

    .notification-icon {
        width: 40px;
        height: 40px;
        min-width: 40px;
        border-radius: 9px;
        background: #ecfdf3;
        color: #16a34a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
    }

    .notification-title {
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 3px;
    }

    .notification-description {
        color: #8b95a1;
        font-size: 12px;

        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* ==============================
       Recipient
    ============================== */

    .recipient-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 7px;
        background: #f3f4f6;
        color: #4b5563;
        font-size: 12px;
        font-weight: 600;
    }

    .recipient-badge i {
        color: #16a34a;
    }

    /* ==============================
       Date
    ============================== */

    .notification-date {
        white-space: nowrap;
    }

    .notification-date strong {
        display: block;
        color: #374151;
        font-size: 13px;
        font-weight: 600;
    }

    .notification-date span {
        color: #9ca3af;
        font-size: 11px;
    }

    /* ==============================
       Action
    ============================== */

    .notification-action-btn {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e5e7eb;
        background: #fff;
        color: #6b7280;
    }

    .notification-action-btn:hover {
        background: #f3f4f6;
        color: #111827;
    }

    .notifications-card .dropdown-menu {
        border: 1px solid #edf0f3;
        border-radius: 9px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        padding: 6px;
    }

    .notifications-card .dropdown-item {
        border-radius: 6px;
        font-size: 13px;
        padding: 9px 11px;
    }

    .notifications-card .dropdown-item i {
        margin-right: 7px;
    }

    /* ==============================
       Empty State
    ============================== */

    .notification-empty-state {
        text-align: center;
        padding: 65px 20px;
    }

    .notification-empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 15px;
        border-radius: 50%;
        background: #ecfdf3;
        color: #16a34a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    .notification-empty-state h5 {
        font-weight: 700;
        color: #374151;
        margin-bottom: 6px;
    }

    .notification-empty-state p {
        color: #9ca3af;
        font-size: 13px;
        margin-bottom: 20px;
    }

    /* ==============================
       Mobile
    ============================== */

    @media (max-width: 767px) {

        .page-header-modern {
            align-items: flex-start;
        }

        .page-header-modern .title h4 {
            font-size: 21px;
        }

        .notification-create-btn {
            width: 100%;
            justify-content: center;
        }

        .notifications-card-header {
            padding: 17px;
        }

        .notifications-table {
            min-width: 900px;
        }

        .notifications-table-wrapper {
            overflow-x: auto;
        }

        .notification-description {
            max-width: 220px;
        }
    }
</style>


<div class="main-container notifications-page">

    {{-- ==============================
        Page Header
    ============================== --}}
    <div class="page-header-modern">

        <div class="title">
            <h4>
                Notifications
            </h4>

            <p>
                View and manage notifications sent to your agents.
            </p>
        </div>

        <a href="{{ route('notification.create') }}"
           class="notification-create-btn">

            <i class="dw dw-add"></i>

            Send Notification

        </a>

    </div>


    {{-- ==============================
        Statistics
    ============================== --}}
    <div class="row mb-4">

        {{-- Total --}}
        <div class="col-lg-4 col-md-4 col-sm-6 mb-3">

            <div class="notification-stat-card">

                <div class="stat-icon">
                    <i class="dw dw-notification"></i>
                </div>

                <h3>
                    {{ $notifications->count() }}
                </h3>

                <p>
                    Total Notifications
                </p>

            </div>

        </div>


        {{-- This Month --}}
        <div class="col-lg-4 col-md-4 col-sm-6 mb-3">

            <div class="notification-stat-card">

                <div class="stat-icon">
                    <i class="dw dw-calendar"></i>
                </div>

                <h3>
                    {{ $notifications->where('created_at', '>=', now()->startOfMonth())->count() }}
                </h3>

                <p>
                    Sent This Month
                </p>

            </div>

        </div>


        {{-- Today --}}
        <div class="col-lg-4 col-md-4 col-sm-12 mb-3">

            <div class="notification-stat-card">

                <div class="stat-icon">
                    <i class="dw dw-time"></i>
                </div>

                <h3>
                    {{ $notifications->where('created_at', '>=', now()->startOfDay())->count() }}
                </h3>

                <p>
                    Sent Today
                </p>

            </div>

        </div>

    </div>


    {{-- ==============================
        Notifications Table
    ============================== --}}
      @if(session('message'))

                                <div class="alert alert-success modern-alert alert-dismissible fade show">

                                    <i class="fa fa-check-circle mr-2"></i>

                                    {{ session('message') }}

                                    <button
                                        type="button"
                                        class="close"
                                        data-dismiss="alert"
                                    >
                                        <span>&times;</span>
                                    </button>

                                </div>

                            @endif
    <div class="notifications-card">

        <div class="notifications-card-header">

            <div>
                <h5>
                    Notification History
                </h5>

                <p>
                    A list of all notifications sent from the admin panel.
                </p>
            </div>

        </div>


        <div class="notifications-table-wrapper">

            <table class="data-table table stripe hover nowrap notifications-table">

                <thead>

                    <tr>
                        <th>Notification</th>
                        <th>Recipient</th>
                        <th>Message</th>
                        <th>Date Sent</th>
                        <th class="text-right">Action</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($notifications as $notification)

                        <tr>

                            {{-- Notification --}}
                            <td>

                                <div class="notification-title-wrap">

                                    <div class="notification-icon">
                                        <i class="dw dw-notification"></i>
                                    </div>

                                    <div>

                                        <div class="notification-title">
                                            {{ $notification->title }}
                                        </div>

                                        <div class="notification-description">
                                            {{ $notification->description }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- Recipient --}}
                            <td>

                                <span class="recipient-badge">

                                    <i class="dw dw-user1"></i>

                                    {{ $notification->reciepient }}

                                </span>

                            </td>


                            {{-- Message --}}
                            <td>

                                <div class="notification-description"
                                     style="max-width: 280px;">

                                    {{ $notification->description }}

                                </div>

                            </td>


                            {{-- Date --}}
                            <td>

                                <div class="notification-date">

                                    <strong>
                                        {{ \Carbon\Carbon::parse($notification->created_at)->format('M j, Y') }}
                                    </strong>

                                    <span>
                                        {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                                    </span>

                                </div>

                            </td>


                            {{-- Action --}}
                            <td class="text-right">

                                <div class="dropdown">

                                    <button class="notification-action-btn"
                                            type="button"
                                            data-toggle="dropdown"
                                            aria-expanded="false">

                                        <i class="dw dw-more"></i>

                                    </button>

                                    <div class="dropdown-menu dropdown-menu-right">

                                        {{-- <a href="#"
                                           class="dropdown-item">

                                            <i class="dw dw-eye"></i>
                                            View Notification

                                        </a> --}}

                                        <a href="{{ route('notification.edit', $notification->id) }}"
                                           class="dropdown-item">

                                            <i class="dw dw-edit2"></i>
                                            Edit Notification

                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <a href="{{ route('notification.destroy', $notification->id) }}"
                                           class="dropdown-item text-danger"
                                           onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this notification?')) { document.getElementById('delete-form-{{ $notification->id }}').submit(); }">

                                            <i class="dw dw-delete-3"></i>
                                            Delete Notification

                                        </a>

                                    </div>
                                    <form id="delete-form-{{ $notification->id }}"
                                          action="{{ route('notification.destroy', $notification->id) }}"
                                          method="POST"
                                          style="display: none;">

                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5">

                                <div class="notification-empty-state">

                                    <div class="notification-empty-icon">
                                        <i class="dw dw-notification"></i>
                                    </div>

                                    <h5>
                                        No notifications yet
                                    </h5>

                                    <p>
                                        You haven't sent any notifications to your agents.
                                    </p>

                                    <a href="{{ route('notification.create') }}"
                                       class="notification-create-btn">

                                        <i class="dw dw-add"></i>

                                        Send Your First Notification

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection