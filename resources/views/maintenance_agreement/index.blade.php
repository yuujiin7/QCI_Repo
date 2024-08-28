@include('partials.__header')
@include('partials.__renew')
<?php
$array = array('name' => "Service Report List");
?>

<x-nav />
<section>
    <div class="p-10 sm:ml-64">
        <main class="bg-white max-w-full mx-auto p-8 my-10 rounded-lg shadow-2xl">
            <div class="container mx-auto">
                <div class="flex justify-between items-center mb-4">
                    <!-- Generate CSV Button -->
                    <button id="exportCsv" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Export to CSV
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden display" id="MATable">
                        <thead class="bg-gray-800 text-white text-xs uppercase">
                            <tr>
                                <th scope="col" class="py-3 px-6"> </th>
                                <th scope="col" class="py-3 px-6">Serial Number</th>
                                <th scope="col" class="py-3 px-6">Account Number</th>
                                <th scope="col" class="py-3 px-6">Coverage From</th>
                                <th scope="col" class="py-3 px-6">Coverage To</th>
                                <th scope="col" class="py-3 px-6">Status</th>
                                <th scope="col" class="py-3 px-6">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </main>
    </div>
</section>

@include('partials.__footer')

<script>
document.getElementById('exportCsv').addEventListener('click', function () {
    window.location.href = '/export-maintenance-agreements';
});
</script>
