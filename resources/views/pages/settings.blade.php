@extends('layouts.app')


@section('content')
    <x-settingsNavbar :tab="$tab" />
    <div class="edit-settings-page">
        <h1 class="title"> Edit settings </h1>
        <form action="/settings/payment" method="POST" class="editForm" enctype="multipart/form-data">


            <div class="bank_name">
                <label for="bank_name" required>Bank Name</label>
                <input type="text" name="bank_name" id="bank_name" value={{ $settings['bank_name'] }}>
            </div>
            <div class="bank_account_number">
                <label for="bank_account_number" required>Bank Account Number</label>
                <input type="text" name="bank_account_number" id="bank_account_number"
                    value={{ $settings['bank_account_number'] }}>
            </div>
            <div class="bank_routing_number">
                <label for="bank_routing_number" required>Bank Routing Number</label>
                <input type="text" name="bank_routing_number" id="bank_routing_number"
                    value={{ $settings['bank_routing_number'] }}>
            </div>
            <div class="bank_account_type">
                <label for="bank_account_type" required>Bank Account Type</label>
                <input type="text" name="bank_account_type" id="bank_account_type"
                    value={{ $settings['bank_account_type'] }}>

            </div>
            <div class="bank_account_name">
                <label for="bank_account_name" required>Bank Account Name</label>
                <input type="text" name="bank_account_name" id="bank_account_name"
                    value={{ $settings['bank_account_name'] }}>
            </div>
            <div class="paypal_email">
                <label for="paypal_email" required>Paypal Email</label>
                <input type="text" name="paypal_email" id="paypal_email" value={{ $settings['paypal_email'] }}>
            </div>

            <button type="submit">Save</button>
        </form>
    </div>
@endsection
