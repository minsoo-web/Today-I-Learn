#include <stdio.h>
#include <string.h>

int main(void)
{
    typedef char *string;

    string a;
    printf("what`s your name?\n");
    scanf("%s", a);
    printf("%s", a);

    return 0;
}