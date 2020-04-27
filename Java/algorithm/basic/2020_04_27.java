import java.util.Scanner;
class main {
  public static void main(String[] args) {
		int n;

		System.out.print("Please enter an integer:");
		Scanner scan = new Scanner(System.in);
		n = scan.nextInt();
		
		if(n<=0) {
			System.out.print("0 보다 큰 수를 입력하세요");
			return;
		}
		
		int i=1;
		while(n>=i) {
			int j=1;
			while(i>=j) {
				if(i!=j) {
					if(i%j==0) {
						System.out.println("("+i+","+j+")");
					}	
				}
				j++;
			}
			i++;
		}
		// 여기에 코드를 입력하세요
		
  }
}