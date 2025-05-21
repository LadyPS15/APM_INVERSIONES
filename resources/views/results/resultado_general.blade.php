<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Evaluación Completada</title>
      @vite('resources/css/resultalgen.css')
  
</head>
<body>
    <div class="container">
        <h1>¡Evaluación Completada!</h1>
        <p class="subtitle">Aquí están los resultados de tu evaluación</p>

        <hr>

        <div class="section-title">Resumen del Perfil</div>
        <h1>Resultado General</h1>
            <p>Gracias por tu interés. No has tenido experiencia en metodologías Scrum, por lo que no se realizará evaluación.</p>
            <p>Nombre: {{ $applicant->full_name }}</p>
            <p>Correo: {{ $applicant->email }}</p>
            <p>Carrera: {{ $applicant->career->name }}</p>
            <p>Ciclo: {{ $applicant->academic_cycle }}</p>
            <p>Área de Enfoque: {{ $applicant->specialization->name }}</p>
            <p>Lenguajes de Programación: {{ $applicant->programming_languages }}</p>
            <p>Disponibilidad Horaria: {{ $applicant->availability }}</p>

</body>
</html>