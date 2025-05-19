<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluationQuestion;


class EvaluationQuestionController extends Controller
{
    //// Listar las preguntas con opción de filtrar por categoría
    public function index(Request $request)
    {
        $category = $request->query('category');

        $query = EvaluationQuestion::query();
        if ($category) {
            $query->byCategory($category);
        }
        $questions = $query->paginate(15);

        return view('evaluation_questions.index', compact('questions', 'category'));
    }

    // Mostrar formulario para crear nueva pregunta
    public function create()
    {
        $categories = EvaluationQuestion::categories();
        return view('evaluation_questions.create', compact('categories'));
    }

    // Guardar nueva pregunta
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:1000',
            'category' => 'required|string|in:' . implode(',', EvaluationQuestion::categories()),
        ]);

        EvaluationQuestion::create($request->only('question', 'category'));

        return redirect()->route('evaluation_questions.index')
            ->with('success', 'Pregunta creada correctamente');
    }

    // Mostrar formulario para editar pregunta
    public function edit(EvaluationQuestion $evaluationQuestion)
    {
        $categories = EvaluationQuestion::categories();
        return view('evaluation_questions.edit', compact('evaluationQuestion', 'categories'));
    }

    // Actualizar pregunta
    public function update(Request $request, EvaluationQuestion $evaluationQuestion)
    {
        $request->validate([
            'question' => 'required|string|max:1000',
            'category' => 'required|string|in:' . implode(',', EvaluationQuestion::categories()),
        ]);

        $evaluationQuestion->update($request->only('question', 'category'));

        return redirect()->route('evaluation_questions.index')
            ->with('success', 'Pregunta actualizada correctamente');
    }

    // Eliminar pregunta
    public function destroy(EvaluationQuestion $evaluationQuestion)
    {
        $evaluationQuestion->delete();

        return redirect()->route('evaluation_questions.index')
            ->with('success', 'Pregunta eliminada correctamente');
    }
}
