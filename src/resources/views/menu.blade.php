<x-app-layout>
    <ul id="menu" class="list-group">
        <a href="{{ route('profile.show') }}" data-turbolinks="false">
            <li class="list-group-item text-center">
                Account
                <i class="fa fa-up-right-from-square"></i>
            </li>
        </a>
        <li class="list-group-item text-center">
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button id="logout-button" type="submit" class="btn btn-link p-0 m-0 align-baseline" style="text-decoration: none; color: inherit;">Logout</button>
            </form>
        </li>
    </ul>
</x-app-layout>
