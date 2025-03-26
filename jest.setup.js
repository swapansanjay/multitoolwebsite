// Mock window.matchMedia
Object.defineProperty(window, 'matchMedia', {
    writable: true,
    value: jest.fn().mockImplementation(query => ({
        matches: false,
        media: query,
        onchange: null,
        addListener: jest.fn(),
        removeListener: jest.fn(),
        addEventListener: jest.fn(),
        removeEventListener: jest.fn(),
        dispatchEvent: jest.fn(),
    })),
});

// Mock IntersectionObserver
class IntersectionObserver {
    observe() { return null; }
    disconnect() { return null; }
    unobserve() { return null; }
}
Object.defineProperty(window, 'IntersectionObserver', {
    writable: true,
    configurable: true,
    value: IntersectionObserver,
});

// Mock ResizeObserver
class ResizeObserver {
    observe() { return null; }
    disconnect() { return null; }
    unobserve() { return null; }
}
Object.defineProperty(window, 'ResizeObserver', {
    writable: true,
    configurable: true,
    value: ResizeObserver,
});

// Mock getComputedStyle
Object.defineProperty(window, 'getComputedStyle', {
    value: () => ({
        getPropertyValue: (prop) => {
            if (prop === 'transform') {
                return 'matrix(1, 0, 0, 1, 0, 0)';
            }
            return '';
        },
    }),
});

// Mock requestAnimationFrame
global.requestAnimationFrame = (callback) => setTimeout(callback, 0);
global.cancelAnimationFrame = (id) => clearTimeout(id);

// Mock console methods
const originalConsole = { ...console };
beforeAll(() => {
    global.console = {
        ...console,
        // Keep error and warn for debugging
        error: jest.fn(),
        warn: jest.fn(),
        // Mock other console methods
        log: jest.fn(),
        info: jest.fn(),
        debug: jest.fn(),
    };
});

afterAll(() => {
    global.console = originalConsole;
});

// Mock localStorage
const localStorageMock = {
    getItem: jest.fn(),
    setItem: jest.fn(),
    removeItem: jest.fn(),
    clear: jest.fn(),
};
Object.defineProperty(window, 'localStorage', {
    value: localStorageMock,
});

// Mock sessionStorage
const sessionStorageMock = {
    getItem: jest.fn(),
    setItem: jest.fn(),
    removeItem: jest.fn(),
    clear: jest.fn(),
};
Object.defineProperty(window, 'sessionStorage', {
    value: sessionStorageMock,
});

// Mock fetch
global.fetch = jest.fn(() =>
    Promise.resolve({
        json: () => Promise.resolve({}),
        text: () => Promise.resolve(''),
        blob: () => Promise.resolve(new Blob()),
        arrayBuffer: () => Promise.resolve(new ArrayBuffer(0)),
    })
);

// Mock URL
global.URL.createObjectURL = jest.fn();
global.URL.revokeObjectURL = jest.fn();

// Mock navigator
Object.defineProperty(global.navigator, 'clipboard', {
    value: {
        writeText: jest.fn(),
        readText: jest.fn(),
    },
});

// Mock performance
if (!global.performance) {
    global.performance = {
        now: jest.fn(() => Date.now()),
    };
}

// Mock crypto
if (!global.crypto) {
    global.crypto = {
        getRandomValues: jest.fn((arr) => {
            for (let i = 0; i < arr.length; i++) {
                arr[i] = Math.floor(Math.random() * 256);
            }
        }),
    };
} 