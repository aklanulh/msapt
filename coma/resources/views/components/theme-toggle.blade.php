<!-- Theme Toggle Component -->
<div x-data="{ 
    darkMode: localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches),
    init() {
        this.$watch('darkMode', val => {
            localStorage.setItem('darkMode', val);
            if (val) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });
        
        if (this.darkMode) {
            document.documentElement.classList.add('dark');
        }
    }
}" class="flex items-center">
    <button 
        @click="darkMode = !darkMode"
        class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        :class="darkMode ? 'bg-blue-600' : 'bg-gray-200'"
        type="button"
        role="switch"
        :aria-checked="darkMode.toString()"
    >
        <span class="sr-only">Toggle dark mode</span>
        <span 
            class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"
            :class="darkMode ? 'translate-x-6' : 'translate-x-1'"
        ></span>
    </button>
    <span class="ml-3 text-sm font-medium text-white dark:text-gray-300">
        <span x-show="!darkMode">🌙</span>
        <span x-show="darkMode">☀️</span>
    </span>
</div>
