<form action="/create-user" method="POST"
    class="fixed top-1/2 left-1/2 transform bg-white p-8 rounded-lg
           -translate-x-1/2 -translate-y-1/2 shadow-2xl shadow-grey-900
           flex align-middle justify-center flex-col gap-4 max-w-sm"
>
    @csrf

    <h2 class="text-2xl text-gray-900 text-center">
       Create user
    </h2>

    <div>
        <select name="user_type">
            <option>student</option>
            <option>teacher</option>
            <option>admin</option>
        </select>

        @error('user_type')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>


    <div>
        <input type="text" name="name"
            placeholder="Tomek"
            class="@error('name') is-invalid @enderror"
        />

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>


    <div>
        <input type="text" name="surname"
            placeholder="Nowak"
            class="@error('surname') is-invalid @enderror"
        />

        @error('surname')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>


    <div>
        <input type="email" name="email"
            placeholder="email@domain.com"
            class="@error('email') is-invalid @enderror"
        />

        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>


    <div>
        <input type="password" name="password"
            placeholder="very secure password"
            class="@error('password') is-invalid @enderror"
        />

        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!--teacher-->
    <div>
        <select name="default_room">
            @foreach($rooms as $room)
                <option value="{{ $room->id }}">
                    {{ $room->name }}
                </option>
            @endforeach
        </select>

        @error('default_room')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!--student-->
    <div>
        <select name="class">
            @foreach($classes as $class)
                <option value="{{ $class->id }}">
                    {{ $class->name }}
                </option>
            @endforeach
        </select>

        @error('class')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="d-block rounded-md bg-blue-500 text-white
            text-lg p-2 hover:bg-blue-700 transition-all"
    >
        Submit
    </button>
</form>
