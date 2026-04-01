<form wire:submit="deleteUser" class="p-6">
    <flux:modal name="confirm-user-deletion" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Are you sure you want to delete your account?') }}</flux:heading>
                <flux:subheading>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}</flux:subheading>
            </div>

            <div class="space-y-2">
                <flux:field>
                    <flux:label for="password">{{ __('Password') }}</flux:label>
                    <flux:input wire:model="password" id="password" name="password" type="password" class="mt-1 block w-full" placeholder="{{ __('Password') }}" />
                    <flux:error name="password" />
                </flux:field>
            </div>

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="ghost">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="danger" data-test="confirm-delete-user-button">
                    {{ __('Delete account') }}
                </flux:button>
            </div>
        </div>
    </flux:modal>
</form>