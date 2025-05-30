@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Reclutador de Practicantes</title>
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
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        <h3>Resultados de solicitud de practicantes</h3>
        <p>Listado de los practicantes.</p>
        <table>
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Resultados</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($applicants as $applicant)
                    <tr>
                        <td>
                            {{ $applicant->full_name }}<br>
                            <small>{{ $applicant->email }}</small>
                        </td>
                        {{-- RESULTADOS --}}
                        <td>
                            {{-- Modifica la llamada a openModal para pasar el tipo de modal --}}
                            <img src="https://i.postimg.cc/kXNydScx/img-ver.png" alt="ver" width="18"
                                style="cursor: pointer"
                                onclick="openModal('{{ $applicant->id }}', '{{ $applicant->experiencia_scrum }}')">
                        </td>
                        {{-- Estado --}}
                        <td>
                            @switch($applicant->status)
                                @case('aceptado')
                                    <span class="status-accepted">Aceptado</span>
                                @break

                                @case('denegado')
                                    <span class="status-denied">Denegado</span>
                                @break

                                @default
                                    <span class="status-pending">Pendiente</span>
                            @endswitch
                        </td>
                        <td>
                            <!-- Botón Aceptar -->
                            <form action="{{ route('applicants.accept', $applicant->id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-blue">Aceptar</button>
                            </form>

                            <!-- Botón Eliminar -->
                            <form id="deleteForm-{{ $applicant->id }}"
                                action="{{ route('applicants.destroy', $applicant->id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                {{-- Cambiamos type="submit" a type="button" y el onclick --}}
                                <button type="button" class="btn btn-red"
                                    onclick="openDeleteModal('{{ $applicant->id }}')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4">No hay practicantes registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
                </tbody>
            </table>

            {{-- MODALES: UNO PARA "SIN EXPERIENCIA SCRUM" Y OTRO PARA "CON EXPERIENCIA SCRUM" --}}
            @foreach ($applicants as $applicant)
                {{-- Modal para experiencia_scrum = 'no' (Imagen 1) --}}
                <div id="modal-no-scrum-{{ $applicant->id }}" class="modal" style="display:none;">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal('no-scrum-{{ $applicant->id }}')">&times;</span>
                        <h1>¡Evaluación Completada!</h1>
                        <p class="subtitle">Aquí están los resultados de tu evaluación</p>
                        <hr>

                        <div class="profile-info">
                            <p><strong>Nombre:</strong> <span>{{ $applicant->full_name }}</span></p>
                            <p><strong>Correo Electrónico:</strong> <span>{{ $applicant->email }}</span></p>
                            <p><strong>Carrera:</strong> <span>{{ $applicant->career->name }}</span></p>
                            <p><strong>Ciclo Académico:</strong> <span>{{ $applicant->academic_cycle }}</span></p>
                            <p><strong>Especialización:</strong>
                                <span>{{ optional($applicant->specialization)->name }}</span>
                            </p>
                            <p><strong>Lenguajes de Programación:</strong>
                                <span>{{ $applicant->programming_languages }}</span>
                            </p>
                            <p><strong>Disponibilidad:</strong> <span>{{ $applicant->availability }}</span></p>
                        </div>

                        <div class="score-section">
                            <div class="section-title">Puntuación General como Practicante</div>
                        </div>
                        <p class="total-score">Puntaje Total:
                            <span>{{ number_format($applicant->scrum_score, 1) }}/5.0</span>
                            @if ($applicant->scrum_score >= 4.0)
                                (Muy Bueno)
                            @elseif($applicant->scrum_score >= 3.0)
                                (Bueno)
                            @else
                                (Regular)
                            @endif
                        </p>
                        <div class="footer">
                            <p>Fecha de evaluación: {{ $applicant->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Modal para experiencia_scrum = 'si' (Imagen 2) --}}
                <div id="modal-scrum-{{ $applicant->id }}" class="modal" style="display:none;">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal('scrum-{{ $applicant->id }}')">&times;</span>
                        <h1>¡Evaluación Completada!</h1>
                        <p class="subtitle">Aquí están los resultados de tu evaluación</p>
                        <hr>

                        <div class="profile-info">
                            <p><strong>Nombre:</strong> <span>{{ $applicant->full_name }}</span></p>
                            <p><strong>Correo Electrónico:</strong> <span>{{ $applicant->email }}</span></p>
                            <p><strong>Carrera:</strong> <span>{{ $applicant->career->name }}</span></p>
                            <p><strong>Ciclo Académico:</strong> <span>{{ $applicant->academic_cycle }}</span></p>
                            <p><strong>Especialización:</strong>
                                <span>{{ optional($applicant->specialization)->name }}</span>
                            </p>
                            <p><strong>Lenguajes de Programación:</strong><span>
                                    {{ $applicant->programming_languages }}</span></p>
                            <p><strong>Disponibilidad:</strong><span> {{ $applicant->availability }}</span></p>
                        </div>

                        <div class="score-section">
                            <div class="section-title">Puntuación General como Practicante</div>
                        </div>
                        <p class="total-score">Puntaje Total:
                            <span>{{ number_format($applicant->scrum_score, 1) }}/5.0</span>
                            @if ($applicant->scrum_score >= 4.0)
                                (Muy Bueno)
                            @elseif($applicant->scrum_score >= 2.0)
                                (Bueno)
                            @else
                                (Regular)
                            @endif
                        </p>
                        <div class="role-box">Asignación de Rol: Scrum Master {{ optional($applicant->scrumRole)->name }}
                        </div>
                        @if ($applicant->scrumEvaluation)
                            <p class="scrum-evaluation-score">Puntaje de Evaluación Scrum:
                                {{ $applicant->scrumEvaluation->score }}/10 puntos</p>
                        @else
                            <p class="scrum-evaluation-score">Puntaje de Evaluación Scrum: No evaluado</p>
                        @endif
                        <div class="footer">
                            <p>Fecha de evaluación: {{ $applicant->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- MODAL PARA CONFIRMAR ELIMINACIÓN --}}
            <div id="deleteConfirmationModal" class="modal" style="display:none;">
                <div class="modal-content">
                    <span class="close" onclick="closeDeleteModal()">&times;</span>
                    <h4 style="margin-top:0;">Confirmar Eliminación</h4>
                    <p>¿Estás seguro de que deseas eliminar a este postulante?</p>
                    <div style="text-align: right; margin-top: 20px;">
                        <button type="button" class="btn btn-blue" onclick="closeDeleteModal()"
                            style="margin-right: 10px;">Cancelar</button>
                        <button type="button" id="confirmDeleteModalButton" class="btn btn-red">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Variable global para guardar el ID del postulante a eliminar
            let currentApplicantIdToDelete = null;

            function openModal(applicantId, experienciaScrum) {
                let modalId;
                if (experienciaScrum === 'si') {
                    modalId = 'modal-scrum-' + applicantId;
                } else {
                    modalId = 'modal-no-scrum-' + applicantId;
                }
                document.getElementById(modalId).style.display = 'flex';
            }

            function closeModal(fullModalId) {
                document.getElementById('modal-' + fullModalId).style.display = 'none';
            }

            window.onclick = function(event) {
                document.querySelectorAll('.modal').forEach(modal => {
                    if (event.target === modal) {
                        modal.style.display = "none";
                    }
                });
            };

            // NUEVAS FUNCIONES PARA EL MODAL DE ELIMINACIÓN
            function openDeleteModal(applicantId) {
                currentApplicantIdToDelete = applicantId; // Guarda el ID del postulante
                document.getElementById('deleteConfirmationModal').style.display = 'flex'; // Muestra el modal de eliminación
            }

            function closeDeleteModal() {
                document.getElementById('deleteConfirmationModal').style.display = 'none';
                currentApplicantIdToDelete = null; // Limpia el ID al cerrar
            }

            // Asigna el evento al botón "Aceptar" del modal de eliminación
            document.addEventListener('DOMContentLoaded', function() { // Asegúrate que el DOM esté cargado
                const confirmButton = document.getElementById('confirmDeleteModalButton');
                if (confirmButton) {
                    confirmButton.onclick = function() {
                        if (currentApplicantIdToDelete) {
                            // Encuentra y envía el formulario de eliminación correspondiente
                            const formToSubmit = document.getElementById('deleteForm-' +
                                currentApplicantIdToDelete);
                            if (formToSubmit) {
                                formToSubmit.submit();
                            }
                            closeDeleteModal(); // Cierra el modal después de enviar
                        }
                    };
                }
            });


            // Modifica window.onclick para que también maneje el cierre del nuevo modal y limpie la variable
            window.onclick = function(event) {
                document.querySelectorAll('.modal').forEach(modal => {
                    if (event.target === modal) {
                        modal.style.display = "none";
                        // Si es el modal de confirmación de eliminación, también limpia la variable
                        if (modal.id === 'deleteConfirmationModal') {
                            currentApplicantIdToDelete = null;
                        }
                    }
                });
            };
        </script>
        <script>
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => alert.style.display = 'none');
            }, 4000); // 4 segundos
        </script>
    </body>

    </html>
