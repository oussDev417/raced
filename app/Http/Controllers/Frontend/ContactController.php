<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BenevoleRequest;
use App\Http\Requests\ContactRequest;
use App\Models\Benevole;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Models\Newsletter;
class ContactController extends Controller
{
    /**
     * Affiche le formulaire de contact.
     */
    public function index()
    {
        // Récupérer les paramètres d'en-tête et de pied de page
        $settings = Setting::first();
        $partners = Partner::all();
        return view('frontend.contact.index', compact('settings', 'partners'));
    }

    /**
     * Traite la soumission du formulaire de contact.
     */
    public function store(ContactRequest $request)
    {
        // Valider et récupérer les données
        $data = $request->validated();
        
        // Créer le message de contact
        Contact::create($data);
        
        // Rediriger avec un message de succès
        return redirect()->route('contact')
            ->with('success', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
    }

    /**
     * Affiche le formulaire de devenir bénévole.
     */
    public function benevole()
    {
        // Récupérer les paramètres d'en-tête et de pied de page
        $settings = Setting::first();

        return view('frontend.benevole', compact('settings'));
    }

    public function donation()
    {
        $partners = Partner::all();
        $settings = Setting::first();
        return view('frontend.donation.index', compact('settings', 'partners'));
    }

    /**
     * Traite la soumission du formulaire de bénévole.
     */
    public function storeBenevole(BenevoleRequest $request)
    {
        // Valider et récupérer les données
        $data = $request->validated();
        
        // Créer le bénévole
        Benevole::create($data);
        
        // Rediriger avec un message de succès
        return redirect()->route('home')
            ->with('success', 'Votre demande de bénévolat a été envoyée avec succès. Nous vous contacterons prochainement.');
    }

    public function newsletter(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create($data);

        return redirect()->back()->with('success', 'Vous avez été abonné à notre newsletter.');
    }
}
