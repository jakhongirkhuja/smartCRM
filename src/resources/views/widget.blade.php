@extends('layouts.layout')
@section('widget')
    <div class="widget">
        <h3>Свяжитесь с нами</h3>
        <form id="ticketForm" action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name">Имя</label>
                <input type="text" name="name" id="name" class="form-control" required maxlength="100">
            </div>

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone">Телефон</label>
                <input type="tel" name="phone" id="phone" class="form-control" placeholder="+998901234567"
                    required>
            </div>
            <div class="mb-3">
                <label for="subject">Тема</label>
                <input type="text" name="subject" id="subject" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="message">Сообщение</label>
                <textarea name="message" id="message" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="files">Файлы</label>
                <input type="file" name="files[]" id="files" class="form-control" multiple>
            </div>

            <button type="submit" class="btn btn-primary">Отправить</button>
            <div id="response" class="message"></div>
        </form>


    </div>

    <script>
        document.getElementById('ticketForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = e.target;
            const responseDiv = document.getElementById('response');
            responseDiv.textContent = 'Отправка...';
            responseDiv.className = 'message';

            const formData = new FormData(form);

            try {
                const res = await fetch("{{ url('/api/tickets') }}", {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const result = await res.json();

                if (res.ok) {
                    responseDiv.textContent = 'Заявка успешно отправлена!';
                    responseDiv.classList.add('success');
                    form.reset();
                } else {
                    throw new Error(result.message || 'Ошибка при отправке');
                }
            } catch (err) {
                responseDiv.textContent = err.message;
                responseDiv.classList.add('error');
            }
        });
    </script>
@endsection
