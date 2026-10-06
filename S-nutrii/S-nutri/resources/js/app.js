/*
|--------------------------------------------------------------------------
| S-NUTRI
| JavaScript principal
| Laravel 13 + Blade + Vite
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| 1. INICIALIZACIÓN
|--------------------------------------------------------------------------
*/

document.addEventListener("DOMContentLoaded", () => {
    initTheme();
    initSidebar();
    initAlerts();
    initModals();
    initPasswordToggles();
    initConfirmations();
    initCalendar();
});


/*
|--------------------------------------------------------------------------
| 2. MODO CLARO / OSCURO
|--------------------------------------------------------------------------
*/

function initTheme() {
    const savedTheme = localStorage.getItem("s-nutri-theme");

    const prefersDark = window.matchMedia(
        "(prefers-color-scheme: dark)"
    ).matches;

    const theme = savedTheme
        || (prefersDark ? "dark" : "light");

    applyTheme(theme);

    /*
    |--------------------------------------------------------------------------
    | Botones para cambiar tema
    |--------------------------------------------------------------------------
    */

    const themeButtons = document.querySelectorAll(
        "[data-theme-toggle]"
    );

    themeButtons.forEach((button) => {
        button.addEventListener("click", () => {

            const currentTheme =
                document.documentElement.dataset.theme || "light";

            const newTheme =
                currentTheme === "dark"
                    ? "light"
                    : "dark";

            applyTheme(newTheme);

            localStorage.setItem(
                "s-nutri-theme",
                newTheme
            );
        });
    });
}


/**
 * Aplica el tema al documento.
 */
function applyTheme(theme) {

    document.documentElement.dataset.theme = theme;

    document.body.dataset.theme = theme;

    /*
    |--------------------------------------------------------------------------
    | Actualizar aria-label
    |--------------------------------------------------------------------------
    */

    const buttons = document.querySelectorAll(
        "[data-theme-toggle]"
    );

    buttons.forEach((button) => {

        if (theme === "dark") {

            button.setAttribute(
                "aria-label",
                "Activar modo claro"
            );

            button.setAttribute(
                "title",
                "Activar modo claro"
            );

        } else {

            button.setAttribute(
                "aria-label",
                "Activar modo oscuro"
            );

            button.setAttribute(
                "title",
                "Activar modo oscuro"
            );
        }
    });
}


/*
|--------------------------------------------------------------------------
| 3. SIDEBAR
|--------------------------------------------------------------------------
*/

function initSidebar() {

    const sidebar = document.querySelector(
        ".sidebar"
    );

    const mobileButton = document.querySelector(
        "[data-sidebar-toggle]"
    );

    const overlay = document.querySelector(
        "[data-sidebar-overlay]"
    );

    if (!sidebar) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Abrir / cerrar desde botón
    |--------------------------------------------------------------------------
    */

    if (mobileButton) {

        mobileButton.addEventListener(
            "click",
            () => {

                sidebar.classList.toggle(
                    "is-open"
                );

                if (overlay) {

                    overlay.classList.toggle(
                        "is-visible"
                    );
                }
            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Cerrar mediante overlay
    |--------------------------------------------------------------------------
    */

    if (overlay) {

        overlay.addEventListener(
            "click",
            closeSidebar
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Cerrar al seleccionar navegación en móvil
    |--------------------------------------------------------------------------
    */

    const navLinks = sidebar.querySelectorAll(
        ".nav-link"
    );

    navLinks.forEach((link) => {

        link.addEventListener(
            "click",
            () => {

                if (window.innerWidth <= 768) {
                    closeSidebar();
                }

            }
        );

    });


    /*
    |--------------------------------------------------------------------------
    | Cerrar al redimensionar
    |--------------------------------------------------------------------------
    */

    window.addEventListener(
        "resize",
        () => {

            if (window.innerWidth > 768) {
                closeSidebar();
            }

        }
    );


    function closeSidebar() {

        sidebar.classList.remove(
            "is-open"
        );

        if (overlay) {

            overlay.classList.remove(
                "is-visible"
            );
        }
    }
}


/*
|--------------------------------------------------------------------------
| 4. ALERTAS
|--------------------------------------------------------------------------
*/

function initAlerts() {

    const alerts = document.querySelectorAll(
        "[data-alert]"
    );

    alerts.forEach((alert) => {

        const closeButton =
            alert.querySelector(
                "[data-alert-close]"
            );

        if (closeButton) {

            closeButton.addEventListener(
                "click",
                () => {

                    removeElement(
                        alert
                    );

                }
            );

        }

    });
}


/*
|--------------------------------------------------------------------------
| 5. ELIMINAR ELEMENTO CON ANIMACIÓN
|--------------------------------------------------------------------------
*/

function removeElement(element) {

    if (!element) {
        return;
    }

    element.style.opacity = "0";

    element.style.transform =
        "translateY(-5px)";

    element.style.transition =
        "opacity 180ms ease, transform 180ms ease";

    setTimeout(() => {

        element.remove();

    }, 180);
}


/*
|--------------------------------------------------------------------------
| 6. AUTO-CIERRE DE ALERTAS
|--------------------------------------------------------------------------
*/

document
    .querySelectorAll(
        "[data-auto-dismiss]"
    )
    .forEach((alert) => {

        const seconds =
            Number(
                alert.dataset.autoDismiss
            ) || 5;

        setTimeout(() => {

            removeElement(alert);

        }, seconds * 1000);

    });


/*
|--------------------------------------------------------------------------
| 7. MODALES
|--------------------------------------------------------------------------
*/

function initModals() {

    /*
    |--------------------------------------------------------------------------
    | Abrir modal
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            "[data-modal-open]"
        )
        .forEach((button) => {

            button.addEventListener(
                "click",
                () => {

                    const modalId =
                        button.dataset.modalOpen;

                    openModal(
                        modalId
                    );

                }
            );

        });


    /*
    |--------------------------------------------------------------------------
    | Cerrar modal
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            "[data-modal-close]"
        )
        .forEach((button) => {

            button.addEventListener(
                "click",
                () => {

                    const modal =
                        button.closest(
                            ".modal-backdrop"
                        );

                    closeModal(
                        modal
                    );

                }
            );

        });


    /*
    |--------------------------------------------------------------------------
    | Cerrar haciendo clic fuera
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            ".modal-backdrop"
        )
        .forEach((backdrop) => {

            backdrop.addEventListener(
                "click",
                (event) => {

                    if (
                        event.target === backdrop
                    ) {
                        closeModal(
                            backdrop
                        );
                    }

                }
            );

        });


    /*
    |--------------------------------------------------------------------------
    | Cerrar con ESC
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        "keydown",
        (event) => {

            if (event.key !== "Escape") {
                return;
            }

            const openedModal =
                document.querySelector(
                    ".modal-backdrop.is-open"
                );

            if (openedModal) {
                closeModal(
                    openedModal
                );
            }

        }
    );
}


/**
 * Abre un modal.
 */
function openModal(modalId) {

    const modal =
        document.getElementById(
            modalId
        );

    if (!modal) {
        return;
    }

    modal.classList.add(
        "is-open"
    );

    document.body.style.overflow =
        "hidden";
}


/**
 * Cierra un modal.
 */
function closeModal(modal) {

    if (!modal) {
        return;
    }

    modal.classList.remove(
        "is-open"
    );

    document.body.style.overflow =
        "";
}


/*
|--------------------------------------------------------------------------
| 8. MOSTRAR / OCULTAR CONTRASEÑA
|--------------------------------------------------------------------------
*/

function initPasswordToggles() {

    document
        .querySelectorAll(
            "[data-password-toggle]"
        )
        .forEach((button) => {

            button.addEventListener(
                "click",
                () => {

                    const inputId =
                        button.dataset.passwordToggle;

                    const input =
                        document.getElementById(
                            inputId
                        );

                    if (!input) {
                        return;
                    }

                    if (
                        input.type === "password"
                    ) {

                        input.type =
                            "text";

                        button.setAttribute(
                            "aria-label",
                            "Ocultar contraseña"
                        );

                    } else {

                        input.type =
                            "password";

                        button.setAttribute(
                            "aria-label",
                            "Mostrar contraseña"
                        );

                    }

                }
            );

        });
}


/*
|--------------------------------------------------------------------------
| 9. CONFIRMACIONES
|--------------------------------------------------------------------------
*/

function initConfirmations() {

    document
        .querySelectorAll(
            "[data-confirm]"
        )
        .forEach((element) => {

            element.addEventListener(
                "click",
                (event) => {

                    const message =
                        element.dataset.confirm
                        || "¿Deseas continuar?";

                    const confirmed =
                        window.confirm(
                            message
                        );

                    if (!confirmed) {
                        event.preventDefault();
                    }

                }
            );

        });
}


/*
|--------------------------------------------------------------------------
| 10. CALENDARIO
|--------------------------------------------------------------------------
*/

function initCalendar() {

    const calendar =
        document.querySelector(
            "[data-calendar]"
        );

    if (!calendar) {
        return;
    }

    const grid =
        calendar.querySelector(
            "[data-calendar-grid]"
        );

    const title =
        calendar.querySelector(
            "[data-calendar-title]"
        );

    const previousButton =
        calendar.querySelector(
            "[data-calendar-prev]"
        );

    const nextButton =
        calendar.querySelector(
            "[data-calendar-next]"
        );

    const todayButton =
        calendar.querySelector(
            "[data-calendar-today]"
        );

    const endpoint =
        calendar.dataset.calendarEndpoint;

    if (!grid || !endpoint) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Estado del calendario
    |--------------------------------------------------------------------------
    */

    let currentDate = new Date();

    /*
    |--------------------------------------------------------------------------
    | Render inicial
    |--------------------------------------------------------------------------
    */

    renderCalendar();


    /*
    |--------------------------------------------------------------------------
    | Mes anterior
    |--------------------------------------------------------------------------
    */

    if (previousButton) {

        previousButton.addEventListener(
            "click",
            () => {

                currentDate.setMonth(
                    currentDate.getMonth() - 1
                );

                renderCalendar();

            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Mes siguiente
    |--------------------------------------------------------------------------
    */

    if (nextButton) {

        nextButton.addEventListener(
            "click",
            () => {

                currentDate.setMonth(
                    currentDate.getMonth() + 1
                );

                renderCalendar();

            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Ir al día actual
    |--------------------------------------------------------------------------
    */

    if (todayButton) {

        todayButton.addEventListener(
            "click",
            () => {

                currentDate =
                    new Date();

                renderCalendar();

            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Renderizar calendario
    |--------------------------------------------------------------------------
    */

    async function renderCalendar() {

        updateCalendarTitle();

        const year =
            currentDate.getFullYear();

        const month =
            currentDate.getMonth();

        const firstDay =
            new Date(
                year,
                month,
                1
            );

        const lastDay =
            new Date(
                year,
                month + 1,
                0
            );

        /*
        |--------------------------------------------------------------------------
        | Convertir domingo = 0 a lunes = 0
        |--------------------------------------------------------------------------
        */

        let startDay =
            firstDay.getDay();

        startDay =
            startDay === 0
                ? 6
                : startDay - 1;

        const daysInMonth =
            lastDay.getDate();

        /*
        |--------------------------------------------------------------------------
        | Días del mes anterior
        |--------------------------------------------------------------------------
        */

        const previousMonthLastDay =
            new Date(
                year,
                month,
                0
            ).getDate();

        /*
        |--------------------------------------------------------------------------
        | Limpiar calendario
        |--------------------------------------------------------------------------
        */

        grid.innerHTML = "";

        /*
        |--------------------------------------------------------------------------
        | Encabezados
        |--------------------------------------------------------------------------
        */

        const weekdays = [
            "Lun",
            "Mar",
            "Mié",
            "Jue",
            "Vie",
            "Sáb",
            "Dom"
        ];

        weekdays.forEach((day) => {

            const weekday =
                document.createElement(
                    "div"
                );

            weekday.className =
                "calendar-weekday";

            weekday.textContent =
                day;

            grid.appendChild(
                weekday
            );
        });


        /*
        |--------------------------------------------------------------------------
        | Obtener citas
        |--------------------------------------------------------------------------
        */

        let appointments = [];

        try {

            appointments =
                await fetchAppointments(
                    year,
                    month
                );

        } catch (error) {

            console.error(
                "No fue posible cargar las citas:",
                error
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Crear días anteriores
        |--------------------------------------------------------------------------
        */

        for (
            let i = startDay - 1;
            i >= 0;
            i--
        ) {

            const dayNumber =
                previousMonthLastDay - i;

            const day =
                createCalendarDay(
                    dayNumber,
                    true
                );

            grid.appendChild(
                day
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Crear días actuales
        |--------------------------------------------------------------------------
        */

        for (
            let dayNumber = 1;
            dayNumber <= daysInMonth;
            dayNumber++
        ) {

            const day =
                createCalendarDay(
                    dayNumber,
                    false,
                    appointments
                );

            grid.appendChild(
                day
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Completar hasta 42 celdas
        |--------------------------------------------------------------------------
        */

        const totalCells =
            grid.children.length;

        const remaining =
            42 - totalCells;

        for (
            let dayNumber = 1;
            dayNumber <= remaining;
            dayNumber++
        ) {

            const day =
                createCalendarDay(
                    dayNumber,
                    true
                );

            grid.appendChild(
                day
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Título del mes
    |--------------------------------------------------------------------------
    */

    function updateCalendarTitle() {

        if (!title) {
            return;
        }

        const formatter =
            new Intl.DateTimeFormat(
                "es-MX",
                {
                    month: "long",
                    year: "numeric"
                }
            );

        const text =
            formatter.format(
                currentDate
            );

        title.textContent =
            capitalize(text);
    }


    /*
    |--------------------------------------------------------------------------
    | Crear día
    |--------------------------------------------------------------------------
    */

    function createCalendarDay(
        dayNumber,
        otherMonth = false,
        appointments = []
    ) {

        const day =
            document.createElement(
                "div"
            );

        day.className =
            "calendar-day";

        if (otherMonth) {

            day.classList.add(
                "other-month"
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Número
        |--------------------------------------------------------------------------
        */

        const number =
            document.createElement(
                "div"
            );

        number.className =
            "calendar-day-number";

        number.textContent =
            dayNumber;

        day.appendChild(
            number
        );


        /*
        |--------------------------------------------------------------------------
        | Eventos
        |--------------------------------------------------------------------------
        */

        if (!otherMonth) {

            const dateString =
                formatDate(
                    currentDate.getFullYear(),
                    currentDate.getMonth(),
                    dayNumber
                );

            if (
                isToday(
                    dateString
                )
            ) {

                day.classList.add(
                    "today"
                );
            }


            const events =
                document.createElement(
                    "div"
                );

            events.className =
                "calendar-events";


            const dayAppointments =
                appointments.filter(
                    (appointment) =>
                        appointment.date ===
                        dateString
                );


            dayAppointments.forEach(
                (appointment) => {

                    const event =
                        createCalendarEvent(
                            appointment
                        );

                    events.appendChild(
                        event
                    );

                }
            );


            day.appendChild(
                events
            );
        }

        return day;
    }


    /*
    |--------------------------------------------------------------------------
    | Crear evento
    |--------------------------------------------------------------------------
    */

    function createCalendarEvent(
        appointment
    ) {

        const event =
            document.createElement(
                "a"
            );

        event.className =
            "calendar-event";

        const status =
            appointment.status
            || "pending";

        event.classList.add(
            status
        );

        const time =
            formatTime(
                appointment.time
            );

        event.textContent =
            `${time} · ${appointment.client_name}`;

        if (appointment.url) {

            event.href =
                appointment.url;

        }

        event.title =
            `${appointment.client_name} - ${time}`;

        return event;
    }


    /*
    |--------------------------------------------------------------------------
    | Obtener citas
    |--------------------------------------------------------------------------
    */

    async function fetchAppointments(
        year,
        month
    ) {

        const start =
            new Date(
                year,
                month,
                1
            );

        const end =
            new Date(
                year,
                month + 1,
                0
            );

        const startDate =
            formatDateObject(
                start
            );

        const endDate =
            formatDateObject(
                end
            );

        const url =
            new URL(
                endpoint,
                window.location.origin
            );

        url.searchParams.set(
            "start",
            startDate
        );

        url.searchParams.set(
            "end",
            endDate
        );


        const response =
            await fetch(
                url,
                {
                    headers: {
                        "Accept":
                            "application/json",

                        "X-Requested-With":
                            "XMLHttpRequest"
                    }
                }
            );


        if (!response.ok) {

            throw new Error(
                `HTTP ${response.status}`
            );
        }


        const data =
            await response.json();


        return data.map(
            (appointment) => {

                const startValue =
                    appointment.start
                    || "";

                const [date, time] =
                    startValue.split("T");

                return {
                    ...appointment,

                    date: date,

                    time: time
                        ? time.substring(
                            0,
                            5
                        )
                        : ""
                };

            }
        );
    }
}


/*
|--------------------------------------------------------------------------
| 11. FORMATEAR FECHA
|--------------------------------------------------------------------------
*/

function formatDate(
    year,
    month,
    day
) {

    const monthValue =
        String(
            month + 1
        ).padStart(
            2,
            "0"
        );

    const dayValue =
        String(
            day
        ).padStart(
            2,
            "0"
        );

    return `${year}-${monthValue}-${dayValue}`;
}


/**
 * Formatea Date.
 */
function formatDateObject(date) {

    return formatDate(
        date.getFullYear(),
        date.getMonth(),
        date.getDate()
    );
}


/*
|--------------------------------------------------------------------------
| 12. FORMATEAR HORA
|--------------------------------------------------------------------------
*/

function formatTime(time) {

    if (!time) {
        return "";
    }

    const [hours, minutes] =
        time.split(":");

    const hour =
        Number(hours);

    const suffix =
        hour >= 12
            ? "PM"
            : "AM";

    const hour12 =
        hour % 12 || 12;

    return `${hour12}:${minutes} ${suffix}`;
}


/*
|--------------------------------------------------------------------------
| 13. ¿ES HOY?
|--------------------------------------------------------------------------
*/

function isToday(dateString) {

    const today =
        new Date();

    const todayString =
        formatDateObject(
            today
        );

    return (
        dateString ===
        todayString
    );
}


/*
|--------------------------------------------------------------------------
| 14. CAPITALIZAR
|--------------------------------------------------------------------------
*/

function capitalize(value) {

    if (!value) {
        return "";
    }

    return value.charAt(0).toUpperCase()
        + value.slice(1);
}


/*
|--------------------------------------------------------------------------
| 15. PREVENIR DOBLE ENVÍO
|--------------------------------------------------------------------------
*/

document.addEventListener(
    "submit",
    (event) => {

        const form =
            event.target;

        if (
            !form.matches(
                "[data-prevent-double-submit]"
            )
        ) {
            return;
        }


        const submitButton =
            form.querySelector(
                'button[type="submit"], input[type="submit"]'
            );

        if (!submitButton) {
            return;
        }


        if (
            submitButton.dataset.submitted
        ) {

            event.preventDefault();

            return;
        }


        submitButton.dataset.submitted =
            "true";

        submitButton.disabled =
            true;

        const originalText =
            submitButton.innerHTML;

        submitButton.dataset.originalText =
            originalText;

        submitButton.innerHTML =
            "Procesando...";
    }
);


/*
|--------------------------------------------------------------------------
| 16. FILTROS AUTOMÁTICOS
|--------------------------------------------------------------------------
*/

document
    .querySelectorAll(
        "[data-auto-submit]"
    )
    .forEach((element) => {

        element.addEventListener(
            "change",
            () => {

                const form =
                    element.closest(
                        "form"
                    );

                if (form) {
                    form.submit();
                }

            }
        );

    });


/*
|--------------------------------------------------------------------------
| 17. CONFIRMACIÓN DE LOGOUT
|--------------------------------------------------------------------------
*/

document
    .querySelectorAll(
        "[data-logout]"
    )
    .forEach((element) => {

        element.addEventListener(
            "click",
            (event) => {

                const confirmed =
                    window.confirm(
                        "¿Deseas cerrar tu sesión?"
                    );

                if (!confirmed) {
                    event.preventDefault();
                }

            }
        );

    });


/*
|--------------------------------------------------------------------------
| 18. CSRF PARA FETCH
|--------------------------------------------------------------------------
*/

function getCsrfToken() {

    const meta =
        document.querySelector(
            'meta[name="csrf-token"]'
        );

    return meta
        ? meta.content
        : "";
}


/*
|--------------------------------------------------------------------------
| 19. PETICIONES POST CON FETCH
|--------------------------------------------------------------------------
*/

async function postRequest(
    url,
    data = {}
) {

    const response =
        await fetch(
            url,
            {
                method: "POST",

                headers: {
                    "Content-Type":
                        "application/json",

                    "Accept":
                        "application/json",

                    "X-CSRF-TOKEN":
                        getCsrfToken(),

                    "X-Requested-With":
                        "XMLHttpRequest"
                },

                body:
                    JSON.stringify(data)
            }
        );


    if (!response.ok) {

        throw new Error(
            `HTTP ${response.status}`
        );
    }


    return response.json();
}


/*
|--------------------------------------------------------------------------
| 20. EXPORTAR FUNCIONES
|--------------------------------------------------------------------------
|
| Algunas vistas pueden acceder a estas funciones desde otros scripts
| si posteriormente es necesario.
|--------------------------------------------------------------------------
*/

window.SNutri = {
    applyTheme,
    openModal,
    closeModal,
    postRequest,
    formatTime,
    formatDate,
    capitalize
};