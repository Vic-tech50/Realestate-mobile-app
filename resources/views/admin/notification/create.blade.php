@extends('web.main')

@section('content')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">

    <div class="min-height-200px">

        {{-- Page Header --}}
        <div class="page-header mb-30">
            <div class="row align-items-center">
                <div class="col-md-8 col-sm-12">
                    <div class="title">
                        <h4 class="text-blue mb-1">Send Notification</h4>
                        <p class="text-muted mb-0">
                            Send an important message or announcement to your agents.
                        </p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 text-md-right mt-3 mt-md-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 justify-content-md-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Notification
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        {{-- Notification Form --}}
        <div class="card-box mb-30">

            <div class="pd-30 border-bottom">
                <div class="d-flex align-items-center">
                    <div
                        class="mr-3 d-flex align-items-center justify-content-center"
                        style="
                            width: 50px;
                            height: 50px;
                            border-radius: 12px;
                            background: #e8f1ff;
                            color: #1b5fc6;
                        "
                    >
                        <i class="fa fa-bell" style="font-size: 22px;"></i>
                    </div>

                    <div>
                        <h5 class="mb-1">Create Notification</h5>
                        <p class="text-muted mb-0">
                            Fill in the details below to send a notification.
                        </p>
                    </div>
                </div>
            </div>

            <div class="pd-30">

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Please fix the following errors:</strong>

                        <ul class="mb-0 mt-2 pl-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Success Message --}}
                {{-- @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fa fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                @endif --}}

                 {{-- Success --}}
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

                <form action="{{ route('notification.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        {{-- Title --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Notification Title
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="title"
                                    value="{{ old('title') }}"
                                    class="form-control form-control-lg"
                                    placeholder="e.g. Important Update"
                                    required
                                >

                                <small class="form-text text-muted">
                                    Enter a short and clear title for the notification.
                                </small>
                            </div>
                        </div>

                        {{-- Recipient --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Send Notification To
                                    <span class="text-danger">*</span>
                                </label>

                                <select
                                    name="reciepient"
                                    class="custom-select form-control-lg"
                                    required
                                >
                                    <option value="All"
                                        {{ old('reciepient', 'All') == 'All' ? 'selected' : '' }}>
                                        All Agents
                                    </option>

                                    @foreach($agents as $agent)
                                        <option
                                            value="{{ $agent->id }}"
                                            {{ old('reciepient') == $agent->id ? 'selected' : '' }}
                                        >
                                            {{ $agent->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <small class="form-text text-muted">
                                    Choose whether this notification should be sent to all agents
                                    or a specific agent.
                                </small>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Message
                                    <span class="text-danger">*</span>
                                </label>

                                <textarea
                                    name="description"
                                    rows="7"
                                    class="form-control"
                                    placeholder="Write your notification message here..."
                                    required
                                >{{ old('description') }}</textarea>

                                <small class="form-text text-muted">
                                    Keep your message clear, useful, and easy to understand.
                                </small>
                            </div>
                        </div>

                    </div>

                    {{-- Action Buttons --}}
                    <div class="border-top pt-4 mt-3">
                        <div class="row">

                            <div class="col-md-6 mb-2 mb-md-0">
                                <a
                                    href="{{ route('admin.home') }}"
                                    class="btn btn-light btn-block"
                                >
                                    <i class="fa fa-arrow-left mr-2"></i>
                                    Cancel
                                </a>
                            </div>

                            <div class="col-md-6">
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-block"
                                >
                                    <i class="fa fa-paper-plane mr-2"></i>
                                    Send Notification
                                </button>
                            </div>

                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>


</div>

@endsection
