<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function post(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|string|min:3|max:255',
            'text' => 'bail|required|string|min:3|max:255',
        ]);

        $template = new Template;
        $template->client_id = $request->getAuthenticatedClient()->id;
        $template->name = $request->name;
        $template->text = $request->text;
        $template->save();

        return $template;
    }

    public function list(Request $request)
    {
        $request->validate([
            'page' => 'bail|integer|min:1|max:10',
            'per_page' => 'bail|integer|min:10|max:25',
        ]);

        return Template::forClient($request->getAuthenticatedClient())->paginate($request->per_page ?? 10);
    }

    public function get(Request $request, string $id)
    {
        return Template::forClient($request->getAuthenticatedClient())->findOrFail($id);
    }

    public function patch(Request $request, string $id)
    {
        $request->validate([
            'name' => 'bail|string|min:3|max:255',
            'text' => 'bail|string|min:3|max:255',
        ]);

        $template = Template::forClient($request->getAuthenticatedClient())->findOrFail($id);

        if ($request->has('name')) {
            $template->name = $request->name;
        }
        if ($request->has('text')) {
            $template->text = $request->text;
        }
        $template->save();

        return $template;
    }

    public function delete(Request $request, string $id)
    {
        Template::forClient($request->getAuthenticatedClient())->findOrFail($id)->delete();
    }
}
