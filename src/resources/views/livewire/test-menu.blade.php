{{-- resources/views/components/dynamic-navbar.blade.php --}}
<div id="main-navbar" class="the-navbar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-12 ms-auto me-auto">
                @php
                    $currentRouteName = request()->route()->getName();
                    $idFromRoute = request()->route('id');
                @endphp



                @if((request()->routeIs( 'note.show')))
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                            @if(request()->routeIs( 'note.show'))
                                <h3 class="emoji-wrapper">
                                    <form action="{{ route('note.destroy', ['id' => $idFromRoute]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this note?')">
                                            <i class="fa fa-trash-can"></i>
                                        </button>
                                    </form>
                                </h3>
                            @else
                                <h3 class="emoji-wrapper"></h3> <!-- Leeg voor form routes -->
                            @endif

                            @if(Str::contains($currentRouteName, 'form.'))
                                <h3 class="emoji-wrapper">
                                    <a href="{{ route('note.show', ['id' => $idFromRoute]) }}">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </h3>
                            @elseif($idFromRoute !== null)
                                <h3 class="emoji-wrapper">
                                    <a href="{{ url("/#item-{$idFromRoute}") }}">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </h3>
                            @else
                                <h3 class="emoji-wrapper">
                                    <a href="{{ url('/') }}">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </h3>
                            @endif
                        </div>
                    </div>



                @elseif((request()->routeIs( 'dashboard')))
                    <div class="row">
                        <div class="col-4 d-flex justify-content-start">
                            <h3 class="emoji-wrapper">
                                <a href="{{ route('menu.show') }}" class="{{ request()->is('menu') ? 'active' : '' }}">
                                    <i class="fa fa-bars"></i>
                                </a>
                                <a href="{{ route('note.create') }}" class="{{ request()->is('new') ? 'active' : '' }}">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </h3>
                        </div>
                        <div class="col-8 d-flex justify-content-end">
                            <h3 class="emoji-wrapper {{ count($selectedEmojis ?? []) > 0 ? 'no-invert' : '' }}">
                                @if(count($selectedEmojis ?? []) > 0)
                                    <a href="{{ route('filter.show') }}" class="{{ request()->is('filter') ? 'active' : '' }}">
                                        @foreach(array_slice($selectedEmojis, 0, 3) as $emoji)
                                            <span class="emoji">{{ $emoji }}</span>
                                        @endforeach
                                        @if(count($selectedEmojis) > 3)
                                            <i class="fa fa-ellipsis no-invert"></i>
                                        @endif
                                    </a>
                                @else
                                    <a href="{{ route('filter.show') }}" class="{{ request()->is('filter') ? 'active' : '' }}">
                                        <div class="position-relative d-inline-block">
                                            <i class="fa fa-filter"></i>
{{--                                            @if(count($excludedEmojis) > 0 || !empty($searchQuery))--}}
{{--                                                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-secondary border border-light rounded-circle notifiation-badge">--}}
{{--                                                    <span class="visually-hidden">New notifications</span>--}}
{{--                                                </span>--}}
{{--                                            @endif--}}
                                        </div>
                                    </a>
                                @endif
                            </h3>
                        </div>
                    </div>



                @elseif(Str::contains($currentRouteName, 'filter'))
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                            <h3 class="emoji-wrapper">
                                <a href="{{ route('filter.show') }}" class="{{ request()->routeIs('filter.show') ? 'active' : '' }}">
                                    <div class="position-relative d-inline-block">
                                        <i class="fa fa-filter"></i>
                                        @if(count($selectedEmojis) > 0)
                                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-secondary border border-light rounded-circle notifiation-badge">
                                                <span class="visually-hidden">New notifications</span>
                                            </span>
                                        @endif
                                    </div>
                                </a>
                                <a href="{{ route('filter.exclude.show') }}" class="{{ request()->routeIs('filter.exclude.show') ? 'active' : '' }}">
                                    <div class="position-relative d-inline-block">
                                        <i class="fa fa-ban"></i>
                                        @if(count($excludedEmojis) > 0)
                                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-secondary border border-light rounded-circle notifiation-badge">
                                                <span class="visually-hidden">New notifications</span>
                                            </span>
                                        @endif
                                    </div>
                                </a>
                                <a href="{{ route('filter.search.show') }}" class="{{ request()->routeIs('filter.search.show') ? 'active' : '' }}">
                                    <div class="position-relative d-inline-block">
                                        <i class="fa fa-search"></i>
                                        @if(!empty($searchQuery))
                                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-secondary border border-light rounded-circle notifiation-badge">
                                                <span class="visually-hidden">New notifications</span>
                                            </span>
                                        @endif
                                    </div>
                                </a>
                            </h3>
                            <h3 class="emoji-wrapper">
                                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                                    <i class="fa fa-close"></i>
                                </a>
                            </h3>
                        </div>
                    </div>



                @else
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                            <h3 class="emoji-wrapper">
                                <!-- Leeg voor andere routes zonder specifieke actie -->
                            </h3>
                            <h3 class="emoji-wrapper">
                                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                                    <i class="fa fa-close"></i>
                                </a>
                            </h3>
                        </div>
                    </div>
                @endif



            </div>
        </div>
    </div>
</div>
