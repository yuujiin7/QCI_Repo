

<div>
    <h1>Maintenance Agreement Notification</h1>
    <p>The maintenance agreement with serial number {{ $agreement->serial_number }} is {{ $type }}.</p>
    <p>Details:</p>
    <ul>
        <li>Company Name: {{ $agreement->company_name }}</li>
        <li>Service Level: {{ $agreement->service_level }}</li>
        <li>Start Date: {{ $agreement->start_date }}</li>
        <li>End Date: {{ $agreement->end_date }}</li>
        <li>Account Manager: {{ $agreement->account_manager }}</li>
    </ul>
</div>
