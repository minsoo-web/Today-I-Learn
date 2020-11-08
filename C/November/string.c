#include <stdio.h>
#include <string.h>

int main(void)
{
    char *a;

    printf("hi: ");
    scanf("%s", a);

    int n = strlen(a);
    printf("%i\n", n);

    for (int i = 0; i < n; i++)
    {
        printf("%c", a[i]);
    }

    printf("\n");
    return 0;
}