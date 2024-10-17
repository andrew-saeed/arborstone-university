<div
    id="searching"
    x-data="loadSearching"
>
    <svg id="start-search-btn" width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" @click="open()"> 
        <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>

    <template x-teleport="body">
        <div id="search-box" x-show="toggle" x-transition>
            <div id="search-box__layout">
                <div id="search-box__header">
                    <svg id="close-search-btn" width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" @click="close()"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9.16998 14.83L14.83 9.17004" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14.83 14.83L9.16998 9.17004" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                </div>
                <div id="search-box__body">
                    <input id="search-input" type="text" placeholder="search" @input.debounce.500ms="getData" />
                    <div id="search-loader" role="status" x-show="loading">
                        <svg aria-hidden="true" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                    <ul id="search-result">
                        <template x-for="searchResult in searchResults">
                            <li>
                                <a :href="searchResult.link" x-text="searchResult.title.rendered"></a>
                            </li>
                        </template>
                    </ul>
                    <div id="no-result" x-show="error">no results found</div>
                </div>
            </div>
        </div>
    </template>
</div>