@extends('layouts.app')

{{-- 
    Start of the "content" section.
    Everything inside this section will be inserted into
    @yield('content') in your layouts/app.blade.php file.
--}}
@section('content')

<section class="contact-section">
    <div class="contact-container">

        {{-- 
             Left panel
             This side contains the logo, title, short intro text,
             contact information, and the image block at the bottom.
            --}}
        <div class="contact-left">

            {{-- Brand/logo area --}}
            <div class="contact-brand">
                {{-- 
                    asset('images/logo.png') generates the correct URL
                    to the image inside public/images/logo.png
                --}}
                <img src="{{ asset('images/logo.png') }}" alt="Logo Regardons" class="contact-logo">
            </div>

            {{-- Main heading of the contact page --}}
            <h1 class="contact-title">Nous contacter</h1>

            {{-- Short introduction text --}}
            <p class="contact-text">
                Une question, un projet de collaboration, un signalement ?
                <br>
                Nous vous répondons sous 48 heures ouvrées.
            </p>

            {{-- Thin horizontal separator line --}}
            <div class="contact-divider"></div>

            {{-- List of contact information blocks --}}
            <div class="contact-info-list">

                {{-- Email item --}}
                <div class="contact-info-item">
                    <div class="contact-icon-box">✉</div>
                    <div class="contact-info-text">
                        <span class="contact-label">EMAIL</span>
                        <p>contact@regardons.fr</p>
                    </div>
                </div>

                {{-- Response time item --}}
                <div class="contact-info-item">
                    <div class="contact-icon-box">◔</div>
                    <div class="contact-info-text">
                        <span class="contact-label">RÉPONSE</span>
                        <p>Sous 48 heures ouvrées</p>
                    </div>
                </div>

                {{-- Location item --}}
                <div class="contact-info-item">
                    <div class="contact-icon-box">◎</div>
                    <div class="contact-info-text">
                        <span class="contact-label">LOCALISATION</span>
                        <p>France métropolitaine</p>
                    </div>
                </div>

            </div>

            {{-- Second separator line --}}
            <div class="contact-divider"></div>

            {{-- 
                Image block.
                Replace contact-image.jpg with the real name of your image file.
                Example location: public/images/contact-image.jpg

                alt text should describe the image briefly and clearly.
            --}}
            <div class="contact-image-wrapper">
                <img 
                    src="{{ asset('images/contact-image.jpg') }}" 
                    alt="Illustration paysage nature Regardons" 
                    class="contact-image"
                >
            </div>
        </div>

        {{-- Right panel
             his side contains the contact form. --}}
        <div class="contact-right">

            {{-- Form title --}}
            <h2 class="form-title">Envoyer un message</h2>


            {{--
    <form> creates the form the user will fill in and submit.

    action="{{ route('contact.submit') }}"
    tells Laravel where to send the form data when the user clicks submit.
    route('contact.submit') must match the POST route name in web.php.

    method="POST"
    means the form sends data to the server using the POST HTTP method.
    POST is used when sending or saving data.

    class="contact-form"
    is only for CSS styling.
--}}
<form action="{{ route('contact.submit') }}" method="POST" class="contact-form">

    {{--
        @csrf adds a hidden security token inside the form.

        Laravel requires this token for POST, PUT, PATCH and DELETE forms.
        Without it, Laravel will reject the form submission.
    --}}
    @csrf

    {{--
        This row groups the first name and last name fields side by side.
        It is mainly for layout/styling.
    --}}
    <div class="form-row">

        {{--
            First input block: prénom
            .form-group keeps one label + one field + one error message together.
        --}}
        <div class="form-group">

            {{--
                <label> gives a text label to the input.
                for="prenom" connects this label to the input with id="prenom".
                When the user clicks the label, the input is focused.
            --}}
            <label for="prenom">PRÉNOM</label>

            {{--
                type="text" means this is a normal text field.
                id="prenom" uniquely identifies this input in the page.
                name="prenom" is VERY important:
                this is the key Laravel receives in the request.

                placeholder="Marie"
                is the light example text shown before the user types.

                value="{{ old('prenom') }}"
                tells Laravel:
                if validation fails and the page reloads,
                put the user's previous value back into this input.
                So the user does not need to type everything again.
            --}}
            <input type="text" id="prenom" name="prenom" placeholder="Marie" value="{{ old('prenom') }}">

            {{--
                @error('prenom')
                checks if Laravel validation found an error for the "prenom" field.

                If there is an error, Laravel gives access to a variable called $message.
                That message is printed inside <small>.
            --}}
            @error('prenom')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        {{--
            Second input block: nom
        --}}
        <div class="form-group">

            {{--
                Label for the last name field.
            --}}
            <label for="nom">NOM</label>

            {{--
                Last name input field.

                name="nom" is the name Laravel will use in:
                $request->nom or validation rules for "nom".
            --}}
            <input type="text" id="nom" name="nom" placeholder="Dupont" value="{{ old('nom') }}">

            {{--
                Show validation error for the "nom" field if one exists.
            --}}
            @error('nom')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>
    </div>

    {{--
        Email field block
    --}}
    <div class="form-group">

        {{--
            Label for the email input.
        --}}
        <label for="email">ADRESSE E-MAIL</label>

        {{--
            type="email" tells the browser this field expects an email address.
            It can help with browser validation and mobile keyboard layout.

            name="email" is the request key Laravel receives.
            old('email') restores the previous email if validation fails.
        --}}
        <input type="email" id="email" name="email" placeholder="marie@exemple.fr" value="{{ old('email') }}">

        {{--
            Show validation error message for email if validation fails.
        --}}
        @error('email')
            <small class="field-error">{{ $message }}</small>
        @enderror
    </div>

    {{--
        Subject dropdown block
    --}}
    <div class="form-group">

        {{--
            Label for the subject dropdown.
        --}}
        <label for="sujet">SUJET</label>

        {{--
            <select> creates a dropdown list.

            name="sujet" is the field name Laravel receives.

            The first option has an empty value.
            That is useful because validation can force the user
            to choose a real subject instead of leaving the default one.
        --}}
        <select id="sujet" name="sujet">

            {{--
                Default empty choice.
            --}}
            <option value="">Choisissez un sujet</option>

            {{--
                Each option is one possible subject.

                {{ old('sujet') == 'Question sur un article' ? 'selected' : '' }}
                means:
                if the old submitted value was "Question sur un article",
                automatically mark this option as selected when the page reloads.
            --}}
            <option value="Question sur un article" {{ old('sujet') == 'Question sur un article' ? 'selected' : '' }}>
                Question sur un article
            </option>

            <option value="Collaboration" {{ old('sujet') == 'Collaboration' ? 'selected' : '' }}>
                Collaboration
            </option>

            <option value="Signalement" {{ old('sujet') == 'Signalement' ? 'selected' : '' }}>
                Signalement
            </option>

            <option value="Autre demande" {{ old('sujet') == 'Autre demande' ? 'selected' : '' }}>
                Autre demande
            </option>
        </select>

        {{--
            Show validation error for the dropdown field if needed.
        --}}
        @error('sujet')
            <small class="field-error">{{ $message }}</small>
        @enderror
    </div>

    {{--
        Message textarea block
    --}}
    <div class="form-group">

        {{--
            Label for the message textarea.
        --}}
        <label for="message">MESSAGE</label>

        {{--
            <textarea> is used for longer text.

            id="message" connects it to the label.
            name="message" is the key Laravel receives.
            rows="6" gives it visible height.

            Unlike <input>, textarea value is placed between the opening
            and closing tags, not inside a value="" attribute.

            old('message') restores the typed message after validation fails.
        --}}
        <textarea id="message" name="message" maxlength="140"rows="6" placeholder="Votre message...">{{ old('message') }}</textarea>

        {{--
            Show validation error for the message field if it exists.
        --}}
        @error('message')
            <small class="field-error">{{ $message }}</small>
        @enderror
    </div>

    {{--
        Submit button

        type="submit" tells the browser to send the form data
        to the backend when clicked.
    --}}
    <button type="submit" class="submit-btn">
        ENVOYER LE MESSAGE
    </button>

        </div>

    </div>
</section>

@endsection