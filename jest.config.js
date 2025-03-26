module.exports = {
    testEnvironment: 'jsdom',
    setupFilesAfterEnv: ['<rootDir>/jest.setup.js'],
    moduleNameMapper: {
        '\\.(css|less|scss|sass)$': 'identity-obj-proxy',
        '\\.(jpg|jpeg|png|gif|eot|otf|webp|svg|ttf|woff|woff2|mp4|webm|wav|mp3|m4a|aac|oga)$':
            '<rootDir>/__mocks__/fileMock.js',
    },
    transform: {
        '^.+\\.(js|jsx|ts|tsx)$': 'babel-jest',
    },
    collectCoverageFrom: [
        'js/**/*.{js,jsx}',
        '!js/**/*.test.{js,jsx}',
        '!js/main.js',
    ],
    coverageThreshold: {
        global: {
            branches: 80,
            functions: 80,
            lines: 80,
            statements: 80,
        },
    },
    testMatch: [
        '<rootDir>/js/**/__tests__/**/*.{js,jsx}',
        '<rootDir>/js/**/*.{spec,test}.{js,jsx}',
    ],
    verbose: true,
    testURL: 'http://localhost/',
}; 