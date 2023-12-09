#include <stdio.h>

int main(void) {
	char pos[2] = {0, 0};
	for (char n = getchar() - '0'; n > 0; n--) {
		scanf(" %c%c", &pos[0], &pos[1]);
		for (char c = 'a'; c <= 'h'; c++) {
			if (c != pos[0]) {
				printf("%c%c\n", c, pos[1]);
			}
		}
		for (char c = '1'; c <= '8'; c++) {
			if (c != pos[1]) {
				printf("%c%c\n", pos[0], c);
			}
		}
	}
	return 0;
}
