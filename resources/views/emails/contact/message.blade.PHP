<!-- resources/views/emails/contact/message.blade.php -->

<h1>Nuevo mensaje de contacto</h1>

<p><strong>Nombre:</strong> {{ $contact['name'] }}</p>
<p><strong>Correo electrónico:</strong> {{ $contact['email'] }}</p>
<p><strong>Asunto:</strong> {{ $contact['subject'] }}</p>
<p><strong>Mensaje:</strong></p>
<p>{{ $contact['message'] }}</p>

<p>Este mensaje fue enviado desde el formulario de contacto del sitio web.</p>
