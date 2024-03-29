<div id="reply-comment-container" class="pb-6" x-data="">
    <form 
        id="replyForm" 
        action="{{ route('posts.comments.reply', [$post, $commentParentId, $commentChildId]) }}" 
        method="POST" 
        
        x-data="{
            formData: {
                rating: '',
                name: '',
                email: '',
                comment: '',
                link: '',
                cookies_consent: false,
                notify_on_reply: false,
                recaptchaToken: '', // Initialize recaptcha_token here
            },
            errors: {},
            successMessage: '',

            submitForm(event) {
                this.successMessage = '';
                this.errors = {};
                
                grecaptcha.ready(() => {
                    grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', { action: 'commentReply' }).then((token) => {
                        this.formData.recaptchaToken = token; // Set the token in formData
                        {{-- grecaptcha.reset(); // Reset the reCAPTCHA to get a fresh token --}}

                
                            fetch(`{{ route("posts.comments.reply", [$post, $commentParentId, $commentChildId]) }}`, {                    
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector(`meta[name='csrf-token']`).getAttribute('content'),
                                },
                                body: JSON.stringify(this.formData)
                            })
                            .then(response => {
                                if (response.status === 200) {
                                    return response.json();
                                }
                                throw response;
                            })
                            .then(result => {
                                this.formData = {
                                    rating: '',
                                    name: '',
                                    email: '',
                                    comment: '',
                                    link: '',
                                    cookies_consent: false,
                                    notify_on_reply: false,
                                };
                                this.successMessage = '{{ __("Thank you for reply this comment. If the message is approved, shortly I will be displayed!") }}';
                                // Auto-hide the success message after 5 seconds (5000 milliseconds)
                                setTimeout(() => {
                                    this.successMessage = '';
                                }, 5000);
                            })
                            .catch(async (response) => {
                                                                
                                if (response.status === 422) {
                                    const res = await response.json();
                                    this.errors = res.errors;

                                    // Check if there's a specific error for reCAPTCHA verification
                                    if (this.errors.recaptchaToken) {
                                        // Display the reCAPTCHA verification error
                                        this.errors.recaptchaToken[0] = '{{ __("reCAPTCHA verification failed") }}';
                                    }
                                } else {
                                    // Handle other error cases
                                    console.error('An error occurred:', response.statusText);
                                }
                                //console.log(res);
                            })
                        });
                    }); 
                                        
                    }
                }

            "
            x-on:submit.prevent="submitForm"
            >
                        
        <div class="flex items-center justify-between">
            <h3 class="uppercase my-8"><strong>{{ __("reply to ") }} <span id="get_comment_name">{{ $commentName }}</span></strong></h3>
            <!-- Button to hide the reply form and show the main comment form -->
            
            <x-secondary-button 
                id="close-comment-reply-form" 
                class="h-6 bg-primary-300">
                {{ __('Cancel Reply') }}
            </x-secondary-button>
        </div>
        

        <p class=""><em>{{ __("Your email address will not be published. Required fields are marked*") }}</em></p>

        <div class="mt-5" x-data="">
            <legend><strong>{{ __("Rate the recipe") }}</strong></legend>

            <div class="w-full flex justify-start">
                
                <div x-data="
                    {
                        rating: 0,
                        hoverRating: 0,
                        ratings: [{'amount': 1, 'label':'{{ __("Terrible") }}'}, {'amount': 2, 'label':'{{ __("Bad") }}'}, {'amount': 3, 'label':'{{ __("Okay") }}'}, {'amount': 4, 'label':'{{ __("Good") }}'}, {'amount': 5, 'label':'{{ __("Great") }}'}],
                        rate(amount) {
                            if (this.rating == amount) {
                        this.rating = 0;
                    }
                            else this.rating = amount;
                            this.formData.rating = this.rating;
                        },
                    currentLabel() {
                    let r = this.rating;
                    if (this.hoverRating != this.rating) r = this.hoverRating;
                    let i = this.ratings.findIndex(e => e.amount == r);
                    if (i >=0) {return this.ratings[i].label;} else {return ''};     
                    }
                    }
                    " class="flex flex-col w-full">
                    <div class="flex -ml-3">
                        
                        <template x-for="(star, index) in ratings" :key="index">
                            <button @click.prevent="rate(star.amount)" @mouseover="hoverRating = star.amount" @mouseleave="hoverRating = rating"
                                aria-hidden="true"
                                :title="star.label"
                                class="rounded-sm text-gray-400 fill-current focus:outline-none focus:shadow-outline p-1 w-12 m-0 cursor-pointer"
                                :class="{'text-gray-600': hoverRating >= star.amount, 'text-yellow-400': rating >= star.amount && hoverRating >= star.amount}">
                                <svg class="w-15 transition duration-150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </button>  

                        </template>
                    </div>
                    <div class="">
                        <template x-if="rating || hoverRating">
                            <p x-text="currentLabel()"></p>
                        </template>
                        <template x-if="!rating && !hoverRating">
                            <p class="h-6"></p>
                        </template>
                        <input class="hidden" type="number" name="rating" x-model="rating">

                        <div class="mt-4">
                            <div class="flex align-items">
                                <x-input-label for="comment" :value="__('Comment')" />
                                <span class="-mb-1" x-show="rating != 5">&nbsp;*</span>
                            </div>
        
                            <x-textarea-input id="comment" name="comment" :value="old('comment')" rows="8" cols="45" maxlength="65525" x-model="formData.comment" ::class="errors.comment ? 'border-red-500 focus:border-red-500' : ''" />
                                <template x-if="errors.comment">
                                    <div x-text="errors.comment[0]" class="text-red-500"></div>
                                </template>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>

        {{-- <input type="hidden" id="comment_parent_id" name="comment_parent_id" value="{{ $commentParentId }}">
        <input type="hidden" id="comment_child_id" name="comment_child_id" value="{{ $commentChildId }}"> --}}

        <div class="mt-4">
            <x-input-label for="name" :value="__('Name *')" />
            {{-- <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" x-model="formData.name" x-init="formData.name = '{{ Cookie::get('comment_author_name') }}'" ::class="errors.name ? 'border-red-500' : ''" autocomplete  /> --}}
            @if (auth()->check())
                <div class="flex">
                    <x-text-input id="name" class="block mt-1 w-full" title="{{ __('Your name and email are automatically filled based on your account details.')}} &#10;{{  __('Click \'Edit\' to change them.') }}" type="text" name="name" maxlength="100" :value="old('name')" x-model="formData.name" x-init="formData.name = '{{ auth()->user()->name }}'" ::class="errors.name ? 'border-red-500' : ''" autocomplete />
                    {{-- <button type="button" id="enable-name-comment-field" class="border-primary-500" title="{{ __('Edit') }}">
                        <img class="w-5 ml-5" src="{{ asset('icons/edit.svg') }}" alt="Edit Icon" />
                    </button> --}}
                </div>  
            @else
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" maxlength="100" :value="old('name')" x-model="formData.name" x-init="formData.name = '{{ Cookie::get('comment_author_name') }}'" ::class="errors.name ? 'border-red-500' : ''" autocomplete  />
            @endif
            <template x-if="errors.name">
                <div x-text="errors.name[0]" class="text-red-500"></div>
            </template>
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email *')" />
            {{-- <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" maxlength="100" :value="old('email')" x-model="formData.email" x-init="formData.email = '{{ Cookie::get('comment_author_email') }}'" ::class="errors.email ? 'border-red-500' : ''" autocomplete  /> --}}
            @if (auth()->check())
                <div class="flex">
                    <x-text-input id="email" class="block mt-1 w-full" title="{{ __('Your name and email are automatically filled based on your account details.')}} &#10;{{  __('Click \'Edit\' to change them.') }}" type="text" name="email" maxlength="100" :value="old('email')" x-model="formData.email" x-init="formData.email = '{{ auth()->user()->email }}'" ::class="errors.email ? 'border-red-500' : ''" autocomplete />
                    {{-- <button type="button" id="enable-email-comment-field" class="border-primary-500" title="{{ __('Edit') }}">
                        <img class="w-5 ml-5" src="{{ asset('icons/edit.svg') }}" alt="Edit Icon" />
                    </button> --}}
                </div>  
            @else
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" maxlength="100" :value="old('email')" x-model="formData.email" x-init="formData.email = '{{ Cookie::get('comment_author_email') }}'" ::class="errors.email ? 'border-red-500' : ''" autocomplete  />
            @endif
            <template x-if="errors.email">
                <div x-text="errors.email[0]" class="text-red-500"></div>
            </template>
        </div>

        <div class="mt-4">
            <x-input-label for="link" :value="__('Link')" />
            <x-text-input id="link" class="block mt-1 w-full" type="text" name="link" maxlength="200" :value="old('link')" x-model="formData.link" ::class="errors.link ? 'border-red-500' : ''" />
            <template x-if="errors.link">
                <div x-text="errors.link[0]" class="text-red-500"></div>
            </template>
        </div>

        @if (!Cookie::get('comment_author_name') && !Cookie::get('comment_author_email'))
        <div class="mt-4">
            <x-checkbox-input name="cookies_consent" :value="old('cookies_consent')" x-model="formData.cookies_consent">
                <span>{{ __("Save my name, email in this browser for the next time I comment.") }}</span>
            </x-checkbox-input>
        </div>
        @endif
        
        <div class="mt-4">
            <x-checkbox-input name="notify_on_reply" :value="old('notify_on_reply')" x-model="formData.notify_on_reply">
                <span>{{ __("Notify me if Roberto replies to my comment.") }}</span>
            </x-checkbox-input>
        </div>

        <input type="hidden" name="recaptchaToken" x-ref="recaptchaToken">

        <div class="flex items-center justify-end mt-4">
            <x-primary-button 
            class="ml-3 bg-primary-500 g-recaptcha"
            data-action='submit'
            >
                {{ __('reply comment') }}
            </x-primary-button>
        </div>

        <template x-if="successMessage">
            <div x-text="successMessage" class="py-4 px-6 bg-green-600 text-zinc-100 my-4">{{ __("Thank you for leaving the comment. If the message is approved, shortly I will be displayed") }}</div>
        </template>

        <template x-if="errors.recaptchaToken">
            <div x-text="errors.recaptchaToken" class="py-4 px-6 bg-red-500 text-zinc-100 my-4">{{ __("Thank you for leaving the comment. If the message is approved, I will be shortly displayed") }}</div>
        </template>

    </form>
</div>