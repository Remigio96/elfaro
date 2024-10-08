<!-- resources/views/contact/create.blade.php -->

<x-app-layout>

    @section('content')
        <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-4">Contacto</h2>

            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <!-- Nombre -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="w-full px-3 py-2 border rounded @error('name') border-red-500 @enderror" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Correo Electrónico -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Correo Electrónico</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full px-3 py-2 border rounded @error('email') border-red-500 @enderror" required>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Asunto -->
                <div class="mb-4">
                    <label for="subject" class="block text-gray-700">Asunto</label>
                    <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
                        class="w-full px-3 py-2 border rounded @error('subject') border-red-500 @enderror" required>
                    @error('subject')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Mensaje -->
                <div class="mb-4">
                    <label for="message" class="block text-gray-700">Mensaje</label>
                    <textarea name="message" id="message" rows="5"
                        class="w-full px-3 py-2 border rounded @error('message') border-red-500 @enderror" required>{{ old('message') }}</textarea>
                    @error('message')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="flex justify-end">
                    <a href="{{ url()->previous() }}" class="mr-4 text-gray-700 hover:underline">Cancelar</a>
                    <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">Enviar
                        Mensaje</button>
                </div>
            </form>
            <!-- Mostrar mensaje de éxito (flash message) -->
            @if (session('success'))
                <div id="success-message"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

        </div>
        <!-- JavaScript para hacer desaparecer el mensaje después de 3 segundos -->
        <script>
            setTimeout(function() {
                let alert = document.getElementById('success-message');
                if (alert) {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000); // El mensaje desaparecerá después de 3 segundos
        </script>
    </x-app-layout>
