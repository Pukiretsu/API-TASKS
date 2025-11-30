<div id="message-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-2xl p-6 max-w-sm w-full transform transition-all duration-300 scale-100 opacity-100">
        
        <div class="flex justify-between items-start border-b pb-2 mb-4">
            <h3 id="modal-title" class="text-xl font-bold text-gray-800">Mensaje del Sistema</h3>
            <button onclick="window.taskApp.closeModal()" class="text-gray-400 hover:text-gray-600 transition duration-150 p-1 -mt-1 -mr-1 rounded-full hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>
        <p id="modal-message" class="text-gray-600 mb-6"></p>
    </div>
</div>