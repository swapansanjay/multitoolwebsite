import { validateInput, formatNumber, formatLargeNumber } from '../main';

describe('Unit Converters Utility Functions', () => {
    describe('validateInput', () => {
        it('should validate numeric input', () => {
            expect(validateInput({ value: '123' })).toBe(true);
            expect(validateInput({ value: '123.45' })).toBe(true);
            expect(validateInput({ value: '-123' })).toBe(true);
            expect(validateInput({ value: 'abc' })).toBe(false);
        });

        it('should validate input within min and max bounds', () => {
            expect(validateInput({ value: '5' }, 0, 10)).toBe(true);
            expect(validateInput({ value: '15' }, 0, 10)).toBe(false);
            expect(validateInput({ value: '-5' }, 0, 10)).toBe(false);
        });
    });

    describe('formatNumber', () => {
        it('should format numbers with specified decimal places', () => {
            expect(formatNumber(123.456, 2)).toBe('123.46');
            expect(formatNumber(123.456, 1)).toBe('123.5');
            expect(formatNumber(123.456, 0)).toBe('123');
        });

        it('should handle zero and negative numbers', () => {
            expect(formatNumber(0, 2)).toBe('0.00');
            expect(formatNumber(-123.456, 2)).toBe('-123.46');
        });
    });

    describe('formatLargeNumber', () => {
        it('should format large numbers with K, M, B suffixes', () => {
            expect(formatLargeNumber(1234)).toBe('1.23K');
            expect(formatLargeNumber(1234567)).toBe('1.23M');
            expect(formatLargeNumber(1234567890)).toBe('1.23B');
        });

        it('should handle small numbers without suffixes', () => {
            expect(formatLargeNumber(123)).toBe('123');
            expect(formatLargeNumber(0)).toBe('0');
        });

        it('should handle negative numbers', () => {
            expect(formatLargeNumber(-1234)).toBe('-1.23K');
            expect(formatLargeNumber(-1234567)).toBe('-1.23M');
            expect(formatLargeNumber(-1234567890)).toBe('-1.23B');
        });
    });
}); 