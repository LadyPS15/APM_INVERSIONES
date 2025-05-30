@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Credenciales de Usuarios</title>
    @vite('resources/css/dashboard.css')
</head>

<body>
    <div class="sidebar">
        <h2>APM Inversiones ERL</h2>
        <div class="sidebar-links">
            <a href="{{ route('reclutador.dashboard') }}">Resultados</a>
            <a href="{{ route('reclutador.credenciales') }}">Credenciales</a>
            <a href="{{ route('perfil.show') }}">Mi Perfil</a>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
            </button>
        </form>
    </div>

    <div class="topbar">
        {{ Auth::user()->name }}&nbsp;&nbsp;
        <div class="user-circle">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
    </div>

    <div class="content">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        <h3>Lista de Usuarios</h3>
        <table>
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }} <br> <small>{{ $user->email }}</small></td>
                        <td>
                            <small>{{ $user->contraseña }}</small>
                        </td>
                        <td>
                            {{-- <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-red">Eliminar</button>
                            </form> --}}
                            <!-- Botón para mostrar el modal -->
                            <button class="btn btn-red"
                                onclick="showModal({{ $user->id }}, '{{ $user->name }}')">Eliminar</button>

                            <!-- Formulario oculto -->
                            <form id="delete-form-{{ $user->id }}"
                                action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No hay usuarios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div id="confirmationModal" class="modal hidden">
        <div class="modal-content">
            <h4>¿Estás seguro de eliminar este usuario?</h4>
            <p id="modal-user-name"></p>
            <div class="modal-actions">
                <button class="btn btn-blue" onclick="closeModal()">Cancelar</button>
                <button class="btn btn-red" id="confirmDeleteBtn">Eliminar</button>
            </div>
        </div>
    </div>

    <script>
        let deleteFormId = null;

        function showModal(userId, userName) {
            deleteFormId = `delete-form-${userId}`;
            document.getElementById('modal-user-name').textContent = `Usuario: ${userName}`;
            document.getElementById('confirmationModal').classList.remove('hidden');
        }

        function closeModal() {
            deleteFormId = null;
            document.getElementById('confirmationModal').classList.add('hidden');
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (deleteFormId) {
                document.getElementById(deleteFormId).submit();
            }
        });
    </script>
    <script>
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => alert.style.display = 'none');
        }, 4000); // 4 segundos
    </script>

</body>

<style>
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .modal.hidden {
        display: none;
    }

    .modal-content {
        background: #fff;
        padding: 2rem;
        border-radius: 8px;
        text-align: center;
    }

    .modal-actions {
        margin-top: 1rem;
        display: flex;
        justify-content: center;
        gap: 1rem;
    }

    .btn-gray {
        background-color: #ccc;
        border: none;
        padding: 0.5rem 1rem;
    }
</style>


</html>
